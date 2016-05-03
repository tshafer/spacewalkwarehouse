@extends('admin.layout')

@section('title') All Attendees @stop

@section('content')
  <div class="block">
    <div class="block-title">
      <h2>All Attendees</h2>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="min">ID</th>
            <th>Event</th>
            <th>{!! Html::sort('First Name', 'first_name') !!}</th>
            <th>{!! Html::sort('Last Name', 'last_name') !!}</th>
            <th># Tickets</th>
            <th>Tickets</th>
            <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          @if($attendees->count() > 0)
            @foreach($attendees as $attendee)
              <tr>
                <td>{{$attendee->id}}</td>
                @if($attendee->event)
                  <td>{!!link_to_route('admin.events.show',$attendee->event->name, [$attendee->event->id])!!}</td>
                @else
                  <td></td>
                @endif
                <td>{{$attendee->first_name}}</td>
                <td>{{$attendee->last_name}}</td>
                @if($attendee->ticket)
                  <td>{{$attendee->ticket->count()}}</td>
                @else
                  <td></td>
                @endif
                @if($attendee->ticket_path)
                  <td><a href="{{$attendee->ticketUrl()}}" target="_blank">Download Tickets</a></td>
                @else
                  <td></td>
                @endif
                <td class="min">
                    {!!$attendee->getTableLinks()!!}
                </td>
              </tr>
            @endforeach
          @else
            <tr><td colspan="7">
                There are no attendees available
            </td></tr>
          @endif

      </tbody>
    </table>
      {!! paginate($attendees) !!}
  </div>
@stop