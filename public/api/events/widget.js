(function () {

    var scriptName = 'widget.js';
    var jqueryPath = 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js';
    var jqueryVersion = '1.11.3';
    var delayTimer;
    var paymentPath = 'https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.3.2/jquery.payment.js';
    var stripeUrl = 'https://js.stripe.com/v2/';
    window.url = 'http://tickets.washingtonian.com';

    /******** Get reference to self (scriptTag) *********/
    var allScripts = document.getElementsByTagName('script');
    var targetScripts = [];
    for (var i in allScripts) {
        var name = allScripts[i].src;
        if (name && name.indexOf(scriptName) > 0)
            targetScripts.push(allScripts[i]);
    }
    var scriptTag = targetScripts[targetScripts.length - 1];

    // Get event id
    try {
        window.eventId = document
            .querySelector('script[data-id="washingtonianEvents"][data-event]')
            .getAttribute('data-event');
    } catch (err) {
        window.eventId = scriptTag.dataset.event;
    }
    /**
     * Helper function to load external scripts
     *
     * @param src
     * @param onLoad
     */
    function loadScript(src, onLoad) {
        var script_tag = document.createElement('script');
        script_tag.setAttribute('type', 'text/javascript');
        script_tag.setAttribute('src', src);
        if (script_tag.readyState) {
            script_tag.onreadystatechange = function () {
                if (this.readyState == 'complete' || this.readyState == 'loaded') {
                    onLoad();
                }
            };
        } else {
            script_tag.onload = onLoad;
        }
        (document.getElementsByTagName('head')[0] || document.documentElement).appendChild(script_tag);
    }

    /**
     * Helper function to load external css
     *
     * @param href
     */
    function loadCss(href) {
        var link_tag = document.createElement('link');
        link_tag.setAttribute('type', 'text/css');
        link_tag.setAttribute('rel', 'stylesheet');
        link_tag.setAttribute('href', href);
        (document.getElementsByTagName('head')[0] || document.documentElement).appendChild(link_tag);
    }

    /**
     * load jquery into 'jQuery' variable then call main
     */
    if (window.jQuery === undefined || window.jQuery.fn.jquery !== jqueryVersion) {
        loadScript(jqueryPath, initjQuery);
    } else {
        initjQuery();
    }

    /**
     * Start jQuery engines
     */
    function initjQuery() {
        jQuery = window.jQuery.noConflict(true);
        main();

        loadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js');
    }

    /**
     * The Main function
     */
    function main() {

        var url = window.url + '/api/event/' + window.eventId + '?callback=?';

        jQuery(document).ready(function () {

            loadCss('http://yui.yahooapis.com/pure/0.6.0/pure-min.css');
            loadCss(window.url + '/api/events/app.css');
            loadCss('https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css');
            loadScript(stripeUrl);


            // Let everything load
            setTimeout(function () {
                jQuery.ajax({
                    url: url,
                    jsonpCallback: 'callback',
                    dataType: "jsonp",
                    success: function (response) {

                        deleteCookie('discount');
                        deleteCookie('discount_type');

                        jQuery('#event-widget-container').html(response.html);

                        setTimeout(function () {
                            checkCouponValidity();
                            setStripeKey();
                            updatePricePerTicketAmountFromSelect();
                            formatData();
                            processForm();
                        }, 500);

                    }
                }).fail(function (d, textStatus, error) {
                    scrollTop();
                    jQuery('#event-widget-container').prepend('Unknown Error');
                });
            }, 100);

        });
    }

    /**
     * Process Ticket Form
     */
    function processForm() {

        var form = jQuery('#event-form');

        jQuery.validate({
            form: '#event-form',
            modules: 'security',
            onSuccess: function (form) {
                form.find('button').prop('disabled', true);
                // do other things for a valid form
                var cardExp = jQuery('input.cc-exp'),
                    expArray = cardExp.val().split('/'),
                    expmm = expArray[0].trim(),
                    expyy = expArray[1].trim();

                var cardVal = jQuery('input.cc-num');
                cardVal.removeClass('event-error');
                if (!jQuery.payment.validateCardNumber(cardVal.val())) {
                    cardVal.addClass('event-error');
                    return false;
                }

                cardExp.removeClass('event-error');
                if (!jQuery.payment.validateCardExpiry(expmm, expyy)) {
                    cardExp.addClass('event-error');
                    return false;
                }

                var cardCcv = jQuery('input.cc-cvc');
                cardCcv.removeClass('event-error');
                if (!jQuery.payment.validateCardCVC(cardCcv.val())) {
                    cardCcv.addClass('event-error');
                    return false;
                }

                var form = jQuery(this);
                form.find('button').prop('disabled', true);

                Stripe.card.createToken({
                    name: jQuery('input[name=first_name]').val() + ' ' + jQuery('input[name=last_name]').val(),
                    email: jQuery('input[name=email_address]').val(),
                    number: cardVal.val(),
                    cvc: cardCcv.val(),
                    exp_month: expmm,
                    exp_year: expyy,
                    address_line1: jQuery('input[name=address]').val(),
                    address_city: jQuery('input[name=city]').val(),
                    address_state: jQuery('input[name=state]').val(),
                    address_zip: jQuery('input[name=zipcode]').val(),
                    address_country: 'US'
                }, stripeResponseHandler);

                return false;
            },

        });

    }

    /**
     *  Actually submit data to form process ticket
     *
     * @param status
     * @param response
     */
    function stripeResponseHandler(status, response) {

        var form = jQuery('#event-form');

        if (response.error) {
            // Show the errors on the form
            form.find('.payment-errors').text(response.error.message);
            form.find('button').prop('disabled', false);
        } else {
            var token = response.id;
            form.append(jQuery('<input type="hidden" name="stripeToken" />').val(token));

            var url = window.url + '/api/attendee';

            jQuery.ajax({
                    type: 'POST',
                    url: url,
                    data: form.serialize(),
                    dataType: 'json',
                    encode: true
                })
                .done(function (data) {
                    if (data.error == true) {
                        scrollTop();
                        form.find('.payment-errors').text(data.message);
                        form.find('button').prop('disabled', false);
                    } else {
                        deleteCookie('discount');
                        deleteCookie('discount_type');
                        form.find('.info').text(data.message);
                    }
                });
        }
    }

    /**
     * Check if coupon is valid and update price
     */
    function checkCouponValidity() {

        var couponField = jQuery('input[name=coupon_code]');

        var url = window.url + '/api/coupon';

        clearTimeout(delayTimer);

        delayTimer = setTimeout(function () {
            couponField.on('change', function () {
                jQuery.ajax({
                        type: 'POST',
                        url: url,
                        data: {coupon_code: couponField.val(), event: jQuery("input[name=event_id]").val()},
                        dataType: 'json',
                        encode: true
                    })
                    .done(function (data) {
                        if (data.error == true) {
                            jQuery('#couponMessage').text(data.message).css({'color': 'red'});
                        } else {
                            jQuery('#couponMessage').text(data.message).css({'color': 'green'});

                            if (data.response.amount_off != '0.00') {
                                setCookie("discount", data.response.amount_off, 365);
                                setCookie("discount_type", 'amountoff', 365);
                                updatePriceWithTicket();
                            }
                            else if (data.response.percent_off != 0) {
                                setCookie("discount", data.response.percent_off, 365);
                                setCookie("discount_type", 'percentoff', 365);
                                updatePriceWithTicket();
                            }
                        }
                    });
            });
        }, 1000);

    }

    /**
     * Set the stripe key
     */
    function setStripeKey() {
        setTimeout(function () {
            Stripe.setPublishableKey('pk_live_ZCehtQzdnJaYmtVd3QLMmEKf');
        }, 2000);
    }

    /**
     * Update the ticket price per amount selected
     */
    function updatePricePerTicketAmountFromSelect() {
        jQuery('.ticket_types').on('change', function () {
            jQuery('#event-form').find('button').prop('disabled', false);
            updatePriceWithTicket();
        });
    }

    /**
     * Format the credit card data
     */
    function formatData() {

        if (typeof payment !== 'undefined' && jQuery.isFunction(payment)) {
            jQuery('input.cc-num').payment('formatCardNumber');
            jQuery('input.cc-exp').payment('formatCardExpiry');
            jQuery('input.cc-cvc').payment('formatCardCVC');
            jQuery('[data-numeric]').payment('restrictNumeric');
        } else {
            jQuery.getScript(paymentPath)
                .done(function (script, textStatus) {
                    jQuery('input.cc-num').payment('formatCardNumber');
                    jQuery('input.cc-exp').payment('formatCardExpiry');
                    jQuery('input.cc-cvc').payment('formatCardCVC');
                    jQuery('[data-numeric]').payment('restrictNumeric');
                })
                .fail(function (jqxhr, settings, exception) {
                    console.log('Error loading payment');
                });
        }

    }

    /**
     * Calculate the Discount
     * @returns {*|jQuery}
     */
    function updatePriceWithTicket() {

        var thePrice = 0;

        var percentOff, discount, discountType;

        jQuery('.ticket_types').each(function () {
            if (jQuery(this).val() > 0) {
                thePrice += jQuery(this).data('price') * jQuery(this).val();
            }
        });

        if (getCookie('discount')) {
            discount = getCookie('discount');
        }
        if (getCookie('discount_type')) {
            discountType = getCookie('discount_type');
        }
        if (discountType && discount && thePrice > 0) {
            if (discountType == 'amountoff') {
                thePrice -= discount;
            }
            else if (discountType == 'percentoff') {
                percentOff = fpercent(thePrice, discount);
                thePrice -= percentOff;
            }
        }

        return jQuery('.priceNum').text(thePrice.toFixed(2));

    }


    /**
     * Calculate the percentage off
     * @param amount
     * @param percent
     * @returns {number}
     */
    function fpercent(amount, percent) {
        return amount * percent / 100;
    }

    /**
     * Scroll to top on error
     */
    function scrollTop() {
        jQuery('html,body').animate({
            scrollTop: jQuery("#event-widget-container").offset().top
        });
    }

    /**
     *
     * @param cname
     * @param cvalue
     * @param exdays
     */
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    /**
     *
     * @param cname
     * @returns {*}
     */
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }

    /**
     *
     * @param name
     */
    function deleteCookie(name) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
})
();

