@extends('admin.layout')

@section('title') All Ticket Types @stop

@section('content')
  <div class="block">
    <div class="block-title">
      <div class="block-options pull-right">
        {!! toolbar_link('admin.tickettypes.create', 'fa-plus', 'New Ticket Type') !!}
      </div>
      <h2>All Ticket Types</h2>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="min">ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Max Tickets</th>
          <th>Events</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @if($ticketTypes->count() > 0)
          @foreach($ticketTypes as $ticket)
            <tr>
              <td>{{$ticket->id}}</td>
              <td>{{$ticket->ticket_name}}</td>
              <td>{{$ticket->ticket_price}}</td>
              <td>{{$ticket->max_tickets}}</td>
              <td>
                <ul style="list-style-type: none;margin:0;padding:0;">
                  @foreach($ticket->event->all() as $event)
                    <li><a href="{{route('admin.events.show', [$event->id])}}">{{$event->name}}</a></li>
                  @endforeach
                </ul>
              </td>
              <td class="min">
                {!!$ticket->getTableLinks()!!}
              </td>
            </tr>
          @endforeach
        @else
          <tr><td colspan="6">
              There are no Ticket Types Available
            </td></tr>
        @endif
      </tbody>
    </table>
  </div>
@stop