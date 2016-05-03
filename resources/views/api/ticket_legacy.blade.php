<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css">

    <style type="text/css">
        body {
            padding: 10px;
        }

        .page {

            overflow: hidden;
            page-break-after: always;
        }

    </style>
</head>
<body>

    @foreach($attendee->ticket as $key => $value)
        @if(($key+1) % 2 === 0 && ($key+1) != $attendee->ticket->count())
            <div class="page">
                @endif
                <table style="padding-top: 50px; border-bottom: 1px dashed #000;">
                    <tr>
                        <td>
                            <img src="{{$img}}" style="width:400px;"/>
                            <br/><br/>
                        </td>
                        <td style="vertical-align:top; text-align: center;">
                            <div>
                                <span style="font-size: 18px;font-weight:bold;">{{$attendee->event->name}}</span><br/>
                        <span style="font-size: 14px;">
                            <b>Date:</b> {{$attendee->event->event_start_date}}<br/>
                            <b>Time:</b> {{$attendee->event->event_start_time}}<br/>
                            @if($value->vip)<b>VIP</b>@endif {{$attendee->id}}{{$attendee->event->id}}{{($key+1)}}<br/>
                        </span>
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('http://tickets.washingtonian.com/api/ticket/redeem/'.$attendee->id.$attendee->event->id.($key+1))) !!} ">
                            </div>

                            <div style="text-align:right; font-size: 16px">
                                {{$attendee->first_name}} {{$attendee->last_name}}<br/>
                                Ticket {{($key+1)}} of {{$attendee->ticket->count()}}
                            </div>
                            <br/><br/>
                        </td>
                    </tr>
                </table>

                <br/><br/><br/><br/><br/><br/>
                @if(($key+1) % 2 === 0 && ($key+1) != $attendee->ticket->count())
            </div>
        @endif
    @endforeach

</body>
</html>