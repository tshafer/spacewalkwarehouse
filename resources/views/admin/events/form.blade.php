<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Event Content</h2>
        </div>

        <div class="form-bordered">
            <div class="form-group">
                {!! label('name') !!}
                {!! text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('address') !!}
                {!! text('address', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('city') !!}
                {!! text('city', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! label('state') !!}
                {!! state_select() !!}
            </div>

            <div class="form-group">
                {!! label('zip_code') !!}
                {!! text('zip_code', null, ['class' => 'form-control', 'data-mask' => '99999']) !!}
            </div>

            <div class="form-group">
                {!! label('country') !!}
                {!! country_select() !!}
            </div>


            <div class="form-group">
                {!! label('event_start') !!}

                <div class='input-group date' id='datetimepicker-event-start'>
                    {!! text('event_start', null, ['class' => 'form-control']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
                {!! label('event_end') !!}
                <div class='input-group date' id='datetimepicker-event-end'>
                    {!! text('event_end', null, ['class' => 'form-control']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
                {!! label('max_tickets') !!}
                {!! text('max_tickets', null, ['class' => 'form-control'])!!}
            </div>

            <div class="form-group">
                {!! label('extra_fields') !!} (In html Format)
                {!! textarea('extra_fields', null, ['class' => 'form-control'])!!}
            </div>

            <div class="form-group">
                {!! label('description') !!}
                {!! textarea('description', null, ['class' => 'form-control'])!!}
            </div>


            <div class="form-group">
                {!! label('thank_you_reponse') !!}
                {!! textarea('response', null, ['class' => 'form-control'])!!}
            </div>

            <div class="form-group">
                {!! label('Ticket Types') !!}
                @foreach($ticketTypes as $ticketType)
                    @if(isset($event) && in_array($ticketType->id, $event->ticketTypes->lists('id')->all()))
                        <div class="checkbox">
                            <label>{!! checkbox('ticketType[]', $ticketType->id, true) !!} {{$ticketType->ticket_name}}</label>
                        </div>
                    @else
                        <div class="checkbox">
                            <label>{!! checkbox('ticketType[]', $ticketType->id) !!} {{$ticketType->ticket_name}}</label>
                        </div>
                    @endif
                @endforeach
            </div>


        </div>

    </div>

    <div class="form-group form-actions">
        {!!submit('Save Event', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
