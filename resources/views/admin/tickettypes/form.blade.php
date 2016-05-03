<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Ticket Type Content</h2>
        </div>

        <div class="form-bordered">
            <div class="form-group">
                {!! label('ticket_name') !!}
                {!! text('ticket_name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('ticket_price') !!}
                <div class="input-group">
                    <div class="input-group-addon">$</div>
                    {!! text('ticket_price', null, ['class' => 'form-control', 'id' => 'price', 'data-thousands' => '']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! label('max_tickets') !!}
                {!! number('max_tickets', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('start_time') !!}
                <div class='input-group date' id='datetimepicker-start-time'>
                    {!! text('start_time', null, ['class' => 'form-control']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
                {!! label('end_time') !!}
                <div class='input-group date' id='datetimepicker-end-time'>
                    {!! text('end_time', null, ['class' => 'form-control']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
                {!! label('events') !!}
                @foreach($events as $event)
                    @if(isset($ticketType) && in_array($event->id, $ticketType->event->lists('id')->all()))
                        <div class="checkbox">
                            <label>{!! checkbox('event[]', $event->id, true) !!} {{$event->name}}</label>
                        </div>
                    @else
                        <div class="checkbox">
                            <label>{!! checkbox('event[]', $event->id) !!} {{$event->name}}</label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="form-group form-actions">
        {!!submit('Save Ticket Type', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
