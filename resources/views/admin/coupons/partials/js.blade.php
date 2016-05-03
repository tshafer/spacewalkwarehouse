<script src="/assets/dashboard/js/vendor/jquery.maskMoney.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="/assets/dashboard/js/vendor/bootstrap-datetimepicker.min.js"></script>

<script>
    $(function () {
        $('#amount_off').maskMoney();
        $('#redeem_by').datetimepicker();
    });
</script>