@extends('admin.layout')

@section('title') Event @stop

@section('subtitle') {{$event->name}} @stop

@section('content')
  <div class="row">
    <div class="col-md-8">

      <div class="block">
        <div class="block-title">
          <h2>Event Content</h2>
          <div class="block-options pull-right">

            {!! toolbar_link(['admin.events.edit', $event->id], 'fa-edit', 'Edit Event') !!}
            {!! toolbar_link('admin.events.create', 'fa-plus', 'New Event') !!}
          </div>
        </div>
        <h2>{{$event->name}}</h2>
        {!!$event->description!!}<br/>
        <dl class="dl-horizontal">
          <dt>Address</dt><dd>{!! $event->full_address !!}</dd><br/>
          <dt>Event Start</dt><dd>{{$event->event_start}}</dd>
          <dt>Event End</dt><dd>{{$event->event_end}}</dd>
          <dt>Tickets Sold</dt><dd>{{$event->tickets->count()}}</dd>

          <dt>Max Tickets</dt><dd>{{$event->max_tickets}}</dd>

          <dt>Created At</dt><dd>{{$event->created_at}}</dd>
          <dt>Updated At</dt><dd>{{$event->updated_at}}</dd><br/>
          @if($mediaItems->count())
            <dt>Image</dt><dd><img src="{{$mediaItems->last()->getUrl()}}" style="width: 300px;"></dd><br/>
          @endif
          <dt>Response</dt><dd>{{$event->response}}</dd>
          <dt>Custom Fields</dt><dd>{!! $event->extra_fields !!}</dd>
<br/>
          <dt>Ticket Types</dt><dd>
            <ul style="list-style-type: none;margin:0;padding:0;">
              @foreach($event->ticketTypes->all() as $ticketType)
                <li><a href="{{route('admin.tickettypes.show', [$ticketType->id])}}">{{$ticketType->ticket_name}}</a></li>
              @endforeach
            </ul>
          </dd>
        </dl>

      </div>

      @if($event->attendees->count())
        <div class="block">
          <div class="block-title">
            <h2>Attendees</h2>
          </div>
          <table class="table table-striped">
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th># Tickets</th>
            </tr>
            @foreach($event->attendees as $attendee)
              <tr>
                <td>{{$attendee->first_name }}</td>
                <td>{{$attendee->last_name}}</td>
                <td>{!!link_to_route('admin.attendees.show',$attendee->email, [$attendee->id])!!}</td>
                <td>{{$attendee->ticket->count()}}</td>
              </tr>
            @endforeach
          </table>
        </div>
      @endif
    </div>

    <div class="col-md-4">


      <div class="block">
        <div class="block-title">
          <h2>DANGER ZONE</h2>
        </div>
        {!! Form::open(['route' => ['admin.events.destroy', $event->id], 'method' => 'delete']) !!}
        {!! Form::submit('DELETE EVENT', ['class' => 'btn btn-block btn-danger']) !!}
        {!! Form::close() !!}
        <br/>
      </div>
    </div>
  </div>
@stop