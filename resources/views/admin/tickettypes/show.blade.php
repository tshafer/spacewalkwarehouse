@extends('admin.layout')

@section('title') Ticket Types @stop

@section('subtitle') {{$ticketType->name}} @stop

@section('content')
  <div class="row">
    <div class="col-md-8">

      <div class="block">
        <div class="block-title">
          <h2>Ticket Types Content</h2>
          <div class="block-options pull-right">
            {!! toolbar_link(['admin.tickettypes.edit', $ticketType->id], 'fa-edit', 'Edit Event') !!}
            {!! toolbar_link('admin.tickettypes.create', 'fa-plus', 'New Event') !!}
          </div>
        </div>
        <h2>{{$ticketType->name}}</h2>
        <dl class="dl-horizontal">
          <dt>Ticket Name</dt><dd>{!! $ticketType->ticket_name !!}</dd>
          <dt>Ticket Price</dt><dd>{{$ticketType->ticket_price}}</dd>
          <dt>Max Tickets</dt><dd>{{$ticketType->max_tickets}}</dd>
          <dt>Start Time</dt><dd>{{$ticketType->start_time}}</dd>
          <dt>End Time</dt><dd>{{$ticketType->end_time}}</dd>
          <dt>Events</dt><dd>
            <ul style="list-style-type: none;margin:0;padding:0;">
              @foreach($ticketType->event->all() as $event)
                <li><a href="{{route('admin.events.show', [$event->id])}}">{{$event->name}}</a></li>
              @endforeach
            </ul>
          </dd>
        </dl>
      </div>
    </div>

    <div class="col-md-4">
      <div class="block">
        <div class="block-title">
          <h2>DANGER ZONE</h2>
        </div>
        {!! Form::open(['route' => ['admin.tickettypes.destroy', $ticketType->id], 'method' => 'delete']) !!}
        {!! Form::submit('DELETE TICKET TYPE', ['class' => 'btn btn-block btn-danger']) !!}
        {!! Form::close() !!}
        <br/>
      </div>
    </div>
  </div>
@stop