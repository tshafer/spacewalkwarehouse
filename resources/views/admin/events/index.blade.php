@extends('admin.layout')

@section('title') All Events @stop

@section('content')
  <div class="block">
    <div class="block-title">
      <div class="block-options pull-right">
          {!! toolbar_link('admin.events.create', 'fa-plus', 'New Event') !!}
      </div>
      <h2>All Events</h2>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="min">ID</th>
            <th>{!! Html::sort('Title', 'title') !!}</th>
            <th>{!! Html::sort('Event Start', 'event_start') !!}</th>
          <th>Tickets Sold</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          @if($events->count() > 0)
            @foreach($events as $event)
              <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->name}}</td>
                <td>{{$event->event_start}}</td>
                <td>{{$event->tickets->count()}}</td>
                <td class="min">
                  <a href="{{ route('admin.events.checkin', [$event->id]) }}" class="btn btn-xs btn-info">Check In</a>
                    {!!$event->getTableLinks()!!}
                </td>

              </tr>
            @endforeach
          @else
            <tr><td colspan="4">
                There are no Events Available
            </td></tr>
          @endif

      </tbody>
    </table>
      {!! paginate($events) !!}
  </div>
@stop