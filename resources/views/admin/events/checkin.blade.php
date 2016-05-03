@extends('admin.layout')

@section('title') Event @stop

@section('subtitle') {{$event->name}} ({{$event->tickets->count()}})@stop

@section('content')
    @if($event->attendees->count())
        <table class="table table-striped" id="checkin">
            <tr class='no-sort'>
                <th class="min">#</th>
                <th>Type</th>
                <th>First</th>
                <th>Last</th>
                <th class="hidden-xs">Redeemed At</th>
                <th class="hidden-xs">Scanned with QR</th>
                <th>Tickets</th>
                <th>Checked In</th>
            </tr>
            @foreach($event->tickets->sortBy('redeemed_at') as $id => $ticket)
                @if($ticket->attendee)
                    <tr>
                        <td class="min">{{ $ticket->ticket_id }}</td>
                        <td>{{ isset($ticket->ticketType->ticket_name) ? $ticket->ticketType->ticket_name : '' }}</td>
                        <td>{{ isset($ticket->attendee->first_name) ? $ticket->attendee->first_name : 'None' }}</td>
                        <td>{{ isset($ticket->attendee->last_name) ? $ticket->attendee->last_name : 'None' }}</td>
                        <td class="redeemed_at hidden-xs">{{ $ticket->redeemed_at }}</td>
                        <td class="hidden-xs">{{ $ticket->qr_status_format }}</td>
                      <td>{!! (null !== $ticket->attendee->ticketUrl()) ? '<a href="'.$ticket->attendee->ticketUrl().'" target="_blank">Download Tickets</a>' : '' !!}</td>
                      @if(!$ticket->redeemed_at)
                          <td><a data-id="{{$ticket->id}}" data-loading="Procesing..." data-finished="Checked In" class="progress-button btn btn-md btn-info checkin-button">Check In</a></td>
                      @else
                          <td><a class="progress-button btn btn-lg btn-info checked_in">Checked In</a></td>
                        @endif
                    </tr>
                @endif
            @endforeach
        </table>
    @endif
@endsection

@section('scripts')
    <script>
        new Tablesort(document.getElementById('checkin'));
        $(function(){
            $('.progress-button').progressInitialize();
            $('.checkin-button').one('click', function(e){
                e.preventDefault();
                var button = $(this);
                $.ajax({
                    method: "POST",
                    url:  "{{ route('admin.events.checkin.process') }}",
                    data: { id: button.data('id') }
                })
                        .done(function( msg ) {
                            button.progressTimed(1, function(msg) {
                                button.addClass('progress-button btn btn-lg btn-info checkin-button checked_in').removeAttr('href');
                            });
                        });
            });
        })
    </script>
@stop

@section('styles')

    <style>
        th.sort-header::-moz-selection { background:transparent; }
        th.sort-header::selection      { background:transparent; }
        th.sort-header { cursor:pointer; }
        table th.sort-header:after {
            content:'';
            float:right;
            margin-top:7px;
            border-width:0 4px 4px;
            border-style:solid;
            border-color:#404040 transparent;
            visibility:hidden;
        }
        table th.sort-header:hover:after {
            visibility:visible;
        }
        table th.sort-up:after,
        table th.sort-down:after,
        table th.sort-down:hover:after {
            visibility:visible;
            opacity:0.4;
        }
        table th.sort-up:after {
            border-bottom:none;
            border-width:4px 4px 0;
        }
        .checked_in {
            background-color: #000 !important;
            background-image: none !important;
            cursor: no-drop;
        }
        .progress-button{
            display: inline-block;
            font-size:24px;
            color:#fff !important;
            text-decoration: none !important;
            line-height:1;
            overflow: hidden;
            position:relative;
            box-shadow:0 1px 1px #ccc;
            border-radius:2px;
            background-color: #51b7e6;
            background-image:-webkit-linear-gradient(top, #51b7e6, #4dafdd);
            background-image:-moz-linear-gradient(top, #51b7e6, #4dafdd);
            background-image:linear-gradient(top, #51b7e6, #4dafdd);
        }
        .progress-button.in-progress,
        .progress-button.finished{
            color:transparent !important;
        }
        .progress-button.in-progress:after,
        .progress-button.finished:after{
            position: absolute;
            z-index: 2;
            width: 100%;
            height: 100%;
            text-align: center;
            top: 0;
            padding-top: inherit;
            color: #fff !important;
            left: 0;
        }
        .progress-button.in-progress:after{
            content:attr(data-loading);
        }
        .progress-button.finished:after{
            content:attr(data-finished);
        }
        .progress-button .tz-bar{
            background-color:RED;
            color: #51b7e6;
            height:3px;
            bottom:0;
            left:0;
            width:0;
            position:absolute;
            z-index:1;
            border-radius:0 0 2px 2px;
            -webkit-transition: width 0.5s, height 0.5s;
            -moz-transition: width 0.5s, height 0.5s;
            transition: width 0.5s, height 0.5s;
        }
        .progress-button .tz-bar.background-horizontal{
            height:100%;
            border-radius:2px;
        }
        .progress-button .tz-bar.background-vertical{
            height:0;
            top:0;
            width:100%;
            border-radius:2px;
        }
    </style>
@stop