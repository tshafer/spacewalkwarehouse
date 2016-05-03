@extends('admin.layout')

@section('title') Attendee @stop

@section('subtitle') {{$attendee->name}} @stop

@section('content')
  <div class="row">
    <div class="col-md-6">

      <div class="block">
        <div class="block-title">
          <h2>Attendee Content</h2>
          <div class="block-options pull-right">
          </div>
        </div>
        <h2>{{$attendee->full_name}}</h2>
        <dl class="dl-horizontal">
          <dt>First Name</dt><dd>{{$attendee->first_name}}</dd>
          <dt>Last Name</dt><dd>{{$attendee->last_name}}</dd>
          <dt>Email</dt><dd>{{$attendee->email}}</dd>
          <dt>Address</dt><dd>{{$attendee->address}}</dd>
          <dt>City</dt><dd>{{$attendee->city}}</dd>
          <dt>State</dt><dd>{{$attendee->state}}</dd>
          <dt>Zipcode</dt><dd>{{$attendee->zipcode}}</dd>
          <dt>Event</dt><dd>{!!link_to_route('admin.events.show',$attendee->event->name, [$attendee->event->id])!!}</dd>
          @if($attendee->coupon_code)
            <dt>Coupon Code Used</dt><dd>{!! $attendee->coupon_code !!}</dd>
          @endif
          <dt>Tickets</dt><dd><a href="{{$attendee->ticketUrl()}}" target="_blank">Download Tickets</a></dd>
          <dt>Custom Fields</dt><dd>{{$attendee->extra_fields_answers}}</dd>


        </dl>
      </div>

    </div>
    <div class="col-md-6">


      <div class="block">
        <div class="block-title">
          <h2>Tickets</h2>
        </div>
        @foreach($attendee->ticket as $ticket)
          <div class="form-group">
            @if($ticket->redeemed_at)
              {!! checkbox('ticket', $ticket->ticket_id, true, ['class' => 'mark_as_redeemed', 'disabled']) !!}
            @else
              {!! checkbox('ticket', $ticket->ticket_id, false, ['class' => 'mark_as_redeemed']) !!}
            @endif

            {!! label($ticket->ticket_id) !!}
            <div class="redeemed" style="display:inline-block;">
              @if($ticket->redeemed_at)
                redeemed {{$ticket->redeemed_at}}
              @endif
            </div>

          </div>
        @endforeach

        <br/>
      </div>
    </div>
  </div>
@stop

@section('scripts')
  @include('admin.attendees/partials.js')
@endsection