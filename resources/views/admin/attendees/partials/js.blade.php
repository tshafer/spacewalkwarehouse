<script>
    $(function () {
        $('.mark_as_redeemed').on('click', function () {
            var $that = $(this);
            if (window.location.host == 'wash.app') {
                url = 'http://wash.app/api/ticket/redeem';
            } else {
                url = 'http://tickets.washingtonian.com/api/ticket/redeem';
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: {ticket_id: $that.val()},
                dataType: 'json',
                encode: true
            })
                    .done(function (data) {
                        if (data.error == true) {
                            $that.parent('div').children('.redeemed').text(data.response);
                        } else {
                            $that.prop('disabled', true);
                            $that.parent('div').children('.redeemed').text('redeemed ' + data.response.redeemed_at);
                        }
                    });
        });
    });
</script>