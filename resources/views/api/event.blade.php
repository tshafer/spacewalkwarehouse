<div class="event-container">
    <div class="event-box">

        <form id="event-form" class="pure-form pure-form-stacked" data-parsley-validate>
            {!! token() !!}
            {!! hidden('event_id', $event->id) !!}

            <div class="event-content">

                <div class="details form">
                    <h1>Buy Tickets</h1>
                    @if($event->max_tickets >= $event->tickets->count())
                        <span class="payment-errors"></span>

                        <div class="info">


                            <div class="pure-control-group">
                                @foreach($event->ticketTypes as $ticketType)
                                    @if($ticketType->max_tickets >= $event->tickets->count())
                                        {!! label('Number of ' . $ticketType->ticket_name . ' Tickets') !!}
                                        {!! select('num_tickets['.$ticketType->id.']', range(0,10), null, ['id' => 'num_tickets_'.$ticketType->id, 'class' => 'ticket_types', 'data-price' => $ticketType->ticket_price]) !!}
                                    @endif
                                @endforeach
                                {!! label('Coupon Code') !!}
                                {!! input('text', 'coupon_code',  null, ['placeholder' => 'Coupon Code', 'class' => 'pure-input-1-2']) !!}
                                <div id="couponMessage"></div>
                            </div>
                            @if($event->extra_fields)
                                <div class="pure-control-group">
                                    {!! $event->extra_fields !!}
                                </div>
                            @endif
                            <div class="pure-control-group">

                                {!! label('Personal') !!}
                                <fieldset class="pure-group">
                                    {!! input('text', 'first_name', null, ['placeholder' => 'First Name', 'class' => 'pure-input-1-2', 'data-validation' => 'length', 'data-validation-length' => 'min1', 'id' => 'first_name']) !!}
                                    {!! input('text', 'last_name', null, ['placeholder' => 'Last Name', 'class' => 'pure-input-1-2', 'data-validation' => 'length',  'data-validation-length' => 'min1','id' => 'last_name']) !!}
                                    {!! input('text', 'address',  null, ['placeholder' => 'Address', 'class' => 'pure-input-1-2', 'data-validation' => 'length',  'data-validation-length' => 'min1','id' => 'address']) !!}
                                    {!! input('text', 'city',  null, ['placeholder' => 'City', 'class' => 'pure-input-1-2','data-validation' => 'length', 'data-validation-length' => 'min1', 'id' => 'city']) !!}
                                    {!! input('text', 'state',  null, ['placeholder' => 'State', 'class' => 'pure-input-1-2', 'data-validation' => 'length', 'data-validation-length' => 'min1', 'id' => 'state']) !!}
                                    {!! input('text', 'zipcode',  null, ['placeholder' => 'Zip Code', 'class' => 'pure-input-1-2', 'data-validation' => 'length',  'data-validation-length' => 'min1','id' => 'zipcode']) !!}
                                    {!! input('email', 'email_address',  null, ['placeholder' => 'Email', 'class' => 'pure-input-1-2', 'data-validation' => 'email', 'id' => 'email_address']) !!}

                                </fieldset>
                            </div>

                            <div class="pure-control-group">
                                <fieldset class="cardInfo__cardDetails">

                                    <label for="cc-num">Card Information</label>

                                    <fieldset class="pure-group">
                                        <input id="cc_num" type="tel" class="paymentInput cc-num"
                                               placeholder="•••• •••• •••• ••••" autocompletetype="cc-number">

                                        <input id="cc_exp" type="tel" class="paymentInput cc-exp"
                                               placeholder="MM / YYYY"
                                               autocompletetype="cc-exp"/>

                                        <input id="cc_cvc" type="tel" class="paymentInput cc-cvc" placeholder="CVC"
                                               autocompletetype="cc-cvc" name="cc_cvc"/>
                                    </fieldset>

                                </fieldset>
                            </div>

                            <div class="button-wraper">
                                <div class="price">You will be charged $<span
                                            class="priceNum">0.00</span>.
                                </div>
                                <input type="hidden" name="discount"/>
                                <input type="hidden" name="discount-type"/>
                                <button type="submit" class="submit pure-button pure-button-primary">Purchase</button>
                            </div>
                        </div>
                    @else
                        <div style="text-align:center;"><br/>Sorry, this event has sold out!</div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
