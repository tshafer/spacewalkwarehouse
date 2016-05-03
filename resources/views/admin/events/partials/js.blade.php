<script src="//maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/geocomplete/1.6.5/jquery.geocomplete.min.js"></script>
<script src="/assets/dashboard/js/vendor/jquery.maskMoney.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="/assets/dashboard/js/vendor/bootstrap-datetimepicker.min.js"></script>

<script>
    $(function () {
        $('#price').maskMoney();
        $('#event_start, #event_end').datetimepicker();

        var form = $(".event-form");
        $(".geocomplete", form).geocomplete({
            types: ''
        }).bind("geocode:result", function (event, result) {
            console.log(result);
            var streetNo, route, city, state, zip;

            for (var i = 0; i < result.address_components.length; i++) {
                var component = result.address_components[i];
                var type = component.types[0];
                switch (type) {
                    case 'street_number':
                        streetNo = component.short_name;
                        break;
                    case 'route':
                        route = component.short_name;
                        break;
                    case 'locality':
                        city = component.short_name;
                        break;
                    case 'administrative_area_level_1':
                        state = component.long_name;
                        break;
                    case 'postal_code':
                        zip = component.short_name;
                        break;
                }
            }

            $("#address", form).val(streetNo + ' ' + route);
            $("#city", form).val(city);
            $("#state", form).val(state).trigger('chosen:updated');
            $("#zip", form).val(zip);
        });
    });
</script>