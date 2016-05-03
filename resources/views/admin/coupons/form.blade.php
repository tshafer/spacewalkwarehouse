<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Coupon Content</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! label('event') !!}
                {!! select('event_id', $events, null, ['class' => 'form-control', 'id' => 'event_id']) !!}
            </div>

            <div class="form-group">
                {!! label('Code') !!}
                {!! text('code', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('redeem_by') !!}
                <div class='input-group date' id='datetimepicker-coupon-start'>
                    {!! text('redeem_by', null, ['class' => 'form-control']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            
            <div class="form-group">
                {!! label('amount_off') !!}
                {!! text('amount_off', null, ['class' => 'form-control'])!!}
            </div>

            <div class="form-group">
                {!! label('percent_off') !!}
                {!! number('percent_off', null, ['class' => 'form-control'])!!}
            </div>

            <div class="form-group">
                {!! label('max_redemptions') !!}
                {!! number('max_redemptions', null, ['class' => 'form-control'])!!}
            </div>


        </div>

    </div>
    <div class="form-group form-actions">
        {!!submit('Save Coupon', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
