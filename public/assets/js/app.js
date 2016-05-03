angular.module('washingtonian', []);

angular.module('washingtonian')
    .controller('FitFestController', ['$scope', function ($scope) {

        $scope.selectedCourses = [];

        $scope.addCourse = function (course) {
            if ($scope.selectedCourses.length != 3)
                $scope.selectedCourses.push(course);

        };

        $scope.removeCourse = function (course) {
            var index = $scope.selectedCourses.indexOf(course);
            $scope.selectedCourses.splice(index, 1);
        };

    }]);


// JavaScript Document

function clearText(field) {
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

$(document).ready(function () {
    // some variables
    var sideBarWidth = $('#right-col').width();
    var sidebar = sideBarWidth + 30;
    var contentWidth = $('.story-content').width();

    setInterval(fixAd, 100);

    var docHeight = $(document).height();
    var screenWidth = $(window).width();
    $('.social-col').height(400);


    var url = '/assets//primary-navigation.html#primary-nav';

    $('#toggle').click(function () {
        $("#flyout-menu").fadeIn(100, function () {
            $(this).animate({'left': '0px'}, 300);
            $(this).load(url);
            $(this).addClass('open');
        });
        return false;
    });

    if ($(window).width() > 1024) {
        $('.story').width(contentWidth - sidebar);

    }
    else {
        $('.story').width(contentWidth);
    }

    if (screenWidth < 770) {
        $('li.dropper div').width(screenWidth);
    }

    //////////////// MATCH SIZES ON RESIZE ///////////////////
    $(window).resize(function () {
        var sideBarWidth = $('#right-col').width();
        var sidebar = sideBarWidth + 30;
        var contentWidth = $('.story-content').width();

        if ($(window).width() > 1024) {
            $('.story').width(contentWidth - sidebar);

        }
        else {
            $('.story').width(contentWidth);
        }
    });


    // desktop fixed social media
    function fixAd() {
        var $ad = $('.social-col');
        var bottomSlot = $('.story').height() - 100;
        if ($("h3.kickers").length) {
            var static = $("h3.kickers").position().top;
        } else {
            var static = 0;
        }
        if ($("h3.kickers").length) {
            var readNext = $('#next-slot').position().top;
        } else {
            var readNext = 0;
        }

        var screenHeight = $(window).height() * 1.25;
        var readLess = readNext - screenHeight;

        if ($(window).scrollTop() > ( $ad.data("top") - 10 ) && $(window).scrollTop() < ( $('.story').height() - 100 )) {
            $('.social-col').css({'position': 'fixed', 'top': '10px'});
        } else if ($(window).scrollTop() <= ( $ad.data("top") - 10 )) {
            $('.social-col').css({'position': 'absolute', 'top': static}); //was static/auto, which worked in FF
        }
        else {
            $('.social-col').css({'position': 'absolute', 'top': bottomSlot});
        }

        if ($(window).scrollTop() > readLess) {
            $('i.scroll-top').fadeIn(200);
        }
        else {
            $('i.scroll-top').fadeOut(200);
        }
    }


// column might be omitted on full width stories
    if ($('.social-col').length) {
        $(".social-col").data("top", $(".social-col").offset().top);
    }

    $('.scroll-top').click(function () {
        $('#top-branding').goTo();
    });

// Site Login/Search
    $('.dropper').click(function () {
        $(this).children('div').fadeIn(300);
        $(this).addClass('open');
    });

    // expand comments

    $('#c_arrow').click(function () {
        $('#disqus').slideToggle(600, function () {
            if ($('#disqus').is(':visible')) {
                $('img#c_arrow').attr("src", '/responsive/images/arrow_close.png');
            } else {
                $('img#c_arrow').attr("src", '/responsive/images/comments_arrow.png');
            }
        });
    });

}); // end doc ready functions


$(document).click(function (e) {
    var container = $('#flyout-menu');
    var menuItem = $('li.dropper');

    if (!container.is(e.target)
        && container.has(e.target).length === 0 // target not a descendent of container.
        && container.hasClass('open')) {
        container.animate({'left': '-310px'}, 300, function () {
            container.fadeOut(100);
            container.removeClass('open');
        });
    }

    if (!menuItem.is(e.target)
        && menuItem.has(e.target).length === 0 // target not a descendent of container.
        && menuItem.hasClass('open')) {
        menuItem.children('div').fadeOut(200);
        menuItem.removeClass('open');

    }
});


// select functionality for finder ul
$(function () {
    var selectedItem = $('<i class="fa fa-arrow-circle-down"></i>');
    var finderCount = $('#finder-tools li').length;
    var finderHeight = finderCount * 39;

    $('#finder-tools ul').click(function () {


        if ($(this).height() < 41) {

            $(this).animate({'height': finderHeight}, 300);
            $(this).children('li').css({'position': 'static'});
        }

        else {
            $(this).animate({'height': '38px'}, 200);
            $(this).children('li').css({'position': 'absolute'});
        }

    });


    $('#finder-tools li').click(function () {

        $(this).siblings().removeClass('active-item');
        $(this).addClass('active-item');

        // and go to page
        if ($('#finder-tools ul').height() == finderHeight) {
            var url = $('li.active-item').attr('title');
            window.open(url, '_parent');
        }
    });


    // global finder go button

    $('a#finder-submit').click(function () {
        var url = $('li.active-item').attr('title');
        window.open(url, '_parent');
    });


});

$(document).mouseup(function (e) {
    var container = $('#finder-tools ul');

    if (!container.is(e.target)
        && container.has(e.target).length === 0 // target not a descendent of container.
    ) {
        container.animate({'height': '39px'}, 200);
    }
});

$.fn.goTo = function () {
    $('html, body').animate({
        scrollTop: $(this).offset().top + 'px'
    }, 'slow');
    return this; // chaining if needed
}
/*
 *  jquery-maskmoney - v3.0.2
 *  jQuery plugin to mask data entry in the input text in the form of money (currency)
 *  https://github.com/plentz/jquery-maskmoney
 *
 *  Made by Diego Plentz
 *  Under MIT License (https://raw.github.com/plentz/jquery-maskmoney/master/LICENSE)
 */
!function ($) {
    "use strict";
    $.browser || ($.browser = {}, $.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase()), $.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase()), $.browser.opera = /opera/.test(navigator.userAgent.toLowerCase()), $.browser.msie = /msie/.test(navigator.userAgent.toLowerCase()));
    var a = {
        destroy: function () {
            return $(this).unbind(".maskMoney"), $.browser.msie && (this.onpaste = null), this
        }, mask: function (a) {
            return this.each(function () {
                var b, c = $(this);
                return "number" == typeof a && (c.trigger("mask"), b = $(c.val().split(/\D/)).last()[0].length, a = a.toFixed(b), c.val(a)), c.trigger("mask")
            })
        }, unmasked: function () {
            return this.map(function () {
                var a, b = $(this).val() || "0", c = -1 !== b.indexOf("-");
                return $(b.split(/\D/).reverse()).each(function (b, c) {
                    return c ? (a = c, !1) : void 0
                }), b = b.replace(/\D/g, ""), b = b.replace(new RegExp(a + "$"), "." + a), c && (b = "-" + b), parseFloat(b)
            })
        }, init: function (a) {
            return a = $.extend({
                prefix: "",
                suffix: "",
                affixesStay: !0,
                thousands: ",",
                decimal: ".",
                precision: 2,
                allowZero: !1,
                allowNegative: !1
            }, a), this.each(function () {
                function b() {
                    var a, b, c, d, e, f = s.get(0), g = 0, h = 0;
                    return "number" == typeof f.selectionStart && "number" == typeof f.selectionEnd ? (g = f.selectionStart, h = f.selectionEnd) : (b = document.selection.createRange(), b && b.parentElement() === f && (d = f.value.length, a = f.value.replace(/\r\n/g, "\n"), c = f.createTextRange(), c.moveToBookmark(b.getBookmark()), e = f.createTextRange(), e.collapse(!1), c.compareEndPoints("StartToEnd", e) > -1 ? g = h = d : (g = -c.moveStart("character", -d), g += a.slice(0, g).split("\n").length - 1, c.compareEndPoints("EndToEnd", e) > -1 ? h = d : (h = -c.moveEnd("character", -d), h += a.slice(0, h).split("\n").length - 1)))), {
                        start: g,
                        end: h
                    }
                }

                function c() {
                    var a = !(s.val().length >= s.attr("maxlength") && s.attr("maxlength") >= 0), c = b(), d = c.start, e = c.end, f = c.start !== c.end && s.val().substring(d, e).match(/\d/) ? !0 : !1, g = "0" === s.val().substring(0, 1);
                    return a || f || g
                }

                function d(a) {
                    s.each(function (b, c) {
                        if (c.setSelectionRange)c.focus(), c.setSelectionRange(a, a); else if (c.createTextRange) {
                            var d = c.createTextRange();
                            d.collapse(!0), d.moveEnd("character", a), d.moveStart("character", a), d.select()
                        }
                    })
                }

                function e(b) {
                    var c = "";
                    return b.indexOf("-") > -1 && (b = b.replace("-", ""), c = "-"), c + a.prefix + b + a.suffix
                }

                function f(b) {
                    var c, d, f, g = b.indexOf("-") > -1 && a.allowNegative ? "-" : "", h = b.replace(/[^0-9]/g, ""), i = h.slice(0, h.length - a.precision);
                    return i = i.replace(/^0*/g, ""), i = i.replace(/\B(?=(\d{3})+(?!\d))/g, a.thousands), "" === i && (i = "0"), c = g + i, a.precision > 0 && (d = h.slice(h.length - a.precision), f = new Array(a.precision + 1 - d.length).join(0), c += a.decimal + f + d), e(c)
                }

                function g(a) {
                    var b, c = s.val().length;
                    s.val(f(s.val())), b = s.val().length, a -= c - b, d(a)
                }

                function h() {
                    var a = s.val();
                    s.val(f(a))
                }

                function i() {
                    var b = s.val();
                    return a.allowNegative ? "" !== b && "-" === b.charAt(0) ? b.replace("-", "") : "-" + b : b
                }

                function j(a) {
                    a.preventDefault ? a.preventDefault() : a.returnValue = !1
                }

                function k(a) {
                    a = a || window.event;
                    var d, e, f, h, k, l = a.which || a.charCode || a.keyCode;
                    return void 0 === l ? !1 : 48 > l || l > 57 ? 45 === l ? (s.val(i()), !1) : 43 === l ? (s.val(s.val().replace("-", "")), !1) : 13 === l || 9 === l ? !0 : !$.browser.mozilla || 37 !== l && 39 !== l || 0 !== a.charCode ? (j(a), !0) : !0 : c() ? (j(a), d = String.fromCharCode(l), e = b(), f = e.start, h = e.end, k = s.val(), s.val(k.substring(0, f) + d + k.substring(h, k.length)), g(f + 1), !1) : !1
                }

                function l(c) {
                    c = c || window.event;
                    var d, e, f, h, i, k = c.which || c.charCode || c.keyCode;
                    return void 0 === k ? !1 : (d = b(), e = d.start, f = d.end, 8 === k || 46 === k || 63272 === k ? (j(c), h = s.val(), e === f && (8 === k ? "" === a.suffix ? e -= 1 : (i = h.split("").reverse().join("").search(/\d/), e = h.length - i - 1, f = e + 1) : f += 1), s.val(h.substring(0, e) + h.substring(f, h.length)), g(e), !1) : 9 === k ? !0 : !0)
                }

                function m() {
                    r = s.val(), h();
                    var a, b = s.get(0);
                    b.createTextRange && (a = b.createTextRange(), a.collapse(!1), a.select())
                }

                function n() {
                    setTimeout(function () {
                        h()
                    }, 0)
                }

                function o() {
                    var b = parseFloat("0") / Math.pow(10, a.precision);
                    return b.toFixed(a.precision).replace(new RegExp("\\.", "g"), a.decimal)
                }

                function p(b) {
                    if ($.browser.msie && k(b), "" === s.val() || s.val() === e(o()))a.allowZero ? a.affixesStay ? s.val(e(o())) : s.val(o()) : s.val(""); else if (!a.affixesStay) {
                        var c = s.val().replace(a.prefix, "").replace(a.suffix, "");
                        s.val(c)
                    }
                    s.val() !== r && s.change()
                }

                function q() {
                    var a, b = s.get(0);
                    b.setSelectionRange ? (a = s.val().length, b.setSelectionRange(a, a)) : s.val(s.val())
                }

                var r, s = $(this);
                a = $.extend(a, s.data()), s.unbind(".maskMoney"), s.bind("keypress.maskMoney", k), s.bind("keydown.maskMoney", l), s.bind("blur.maskMoney", p), s.bind("focus.maskMoney", m), s.bind("click.maskMoney", q), s.bind("cut.maskMoney", n), s.bind("paste.maskMoney", n), s.bind("mask.maskMoney", h)
            })
        }
    };
    $.fn.maskMoney = function (b) {
        return a[b] ? a[b].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof b && b ? ($.error("Method " + b + " does not exist on jQuery.maskMoney"), void 0) : a.init.apply(this, arguments)
    }
}(window.jQuery || window.Zepto);
/*!
 * tablesort v3.1.0 (2015-07-03)
 * http://tristen.ca/tablesort/demo/
 * Copyright (c) 2015 ; Licensed MIT
 */
!function () {
    function a(b, c) {
        if (!(this instanceof a))return new a(b, c);
        if (!b || "TABLE" !== b.tagName)throw new Error("Element must be a table");
        this.init(b, c || {})
    }

    var b = [], c = function (a) {
        var b;
        return window.CustomEvent && "function" == typeof window.CustomEvent ? b = new CustomEvent(a) : (b = document.createEvent("CustomEvent"), b.initCustomEvent(a, !1, !1, void 0)), b
    }, d = function (a) {
        return a.getAttribute("data-sort") || a.textContent || a.innerText || ""
    }, e = function (a, b) {
        return a = a.toLowerCase(), b = b.toLowerCase(), a === b ? 0 : b > a ? 1 : -1
    }, f = function (a, b) {
        return function (c, d) {
            var e = a(c.td, d.td);
            return 0 === e ? b ? d.index - c.index : c.index - d.index : e
        }
    };
    a.extend = function (a, c, d) {
        if ("function" != typeof c || "function" != typeof d)throw new Error("Pattern and sort must be a function");
        b.push({name: a, pattern: c, sort: d})
    }, a.prototype = {
        init: function (a, b) {
            var c, d, e, f, g = this;
            if (g.table = a, g.thead = !1, g.options = b, a.rows && a.rows.length > 0 && (a.tHead && a.tHead.rows.length > 0 ? (c = a.tHead.rows[a.tHead.rows.length - 1], g.thead = !0) : c = a.rows[0]), c) {
                var h = function () {
                    g.current && g.current !== this && (g.current.classList.remove("sort-up"), g.current.classList.remove("sort-down")), g.current = this, g.sortTable(this)
                };
                for (e = 0; e < c.cells.length; e++)f = c.cells[e], f.classList.contains("no-sort") || (f.classList.add("sort-header"), f.tabindex = 0, f.addEventListener("click", h, !1), f.classList.contains("sort-default") && (d = f));
                d && (g.current = d, g.sortTable(d))
            }
        }, sortTable: function (a, g) {
            var h, i = this, j = a.cellIndex, k = e, l = "", m = [], n = i.thead ? 0 : 1, o = a.getAttribute("data-sort-method");
            if (i.table.dispatchEvent(c("beforeSort")), g ? h = a.classList.contains("sort-up") ? "sort-up" : "sort-down" : (h = a.classList.contains("sort-up") ? "sort-down" : a.classList.contains("sort-down") ? "sort-up" : i.options.descending ? "sort-up" : "sort-down", a.classList.remove("sort-down" === h ? "sort-up" : "sort-down"), a.classList.add(h)), !(i.table.rows.length < 2)) {
                if (!o) {
                    for (; m.length < 3 && n < i.table.tBodies[0].rows.length;)l = d(i.table.tBodies[0].rows[n].cells[j]), l = l.trim(), l.length > 0 && m.push(l), n++;
                    if (!m)return
                }
                for (n = 0; n < b.length; n++)if (l = b[n], o) {
                    if (l.name === o) {
                        k = l.sort;
                        break
                    }
                } else if (m.every(l.pattern)) {
                    k = l.sort;
                    break
                }
                i.col = j;
                var p, q = [], r = {}, s = 0, t = 0;
                for (n = 0; n < i.table.tBodies.length; n++)for (p = 0; p < i.table.tBodies[n].rows.length; p++)l = i.table.tBodies[n].rows[p], l.classList.contains("no-sort") ? r[s] = l : q.push({
                    tr: l,
                    td: d(l.cells[i.col]),
                    index: s
                }), s++;
                for ("sort-down" === h ? (q.sort(f(k, !0)), q.reverse()) : q.sort(f(k, !1)), n = 0; s > n; n++)r[n] ? (l = r[n], t++) : l = q[n - t].tr, i.table.tBodies[0].appendChild(l);
                i.table.dispatchEvent(c("afterSort"))
            }
        }, refresh: function () {
            void 0 !== this.current && this.sortTable(this.current, !0)
        }
    }, "undefined" != typeof module && module.exports ? module.exports = a : window.Tablesort = a
}();


//# sourceMappingURL=app.js.map