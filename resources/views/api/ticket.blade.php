<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css">

    <style type="text/css">
        body {
            padding: 0px;
            font-family: 'adelle sans', 'trebuchet ms', verdana, arial;
        }

        .page {
            width: 99%;
            overflow: hidden;
            page-break-after: always;
        }

    </style>
</head>
<body>
@foreach($attendee->ticket as $key => $value)
    @if($value->ticketType)
    @if(($key+1) % 2 === 0 && ($key+1) != $attendee->ticket->count())
        <div class="page">
            @endif
            <table style="width:100%; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;">
                <tr style="background:#000; color:#fff;">
                    <td style="padding: 10px;">
                        <span style="font-weight:bold;padding-bottom:10px;display:inline-block; width: 100%;">This is your ticket.</span><br/>
                        Please present this at the event.
                    </td>
                    <td style="text-align:right;">
                        <img src="{{ public_path() }}/img/WashLogoWhite.png"
                             style="position: absolute;width: 200px;padding-top: 14px;padding-left: 40px;"/>
                    </td>
                </tr>
                <tr>
                    <td style="position: absolute;width:60%;height: 217px;">
                        <table style="position: relative;top:0;width:100%;margin-left:1px;margin-top: 1px;border-right: 1px solid #ccc;height: 100%;">
                            <tr>
                                <td style="border-bottom: 1px solid #ccc;padding: 10px;">
                                    <span style="font-size: 18px;font-weight:bold;">{{$attendee->event->name}}</span><br/>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #ccc;padding: 10px;">

                                    @if($value->ticketType->start_time)
                                        <span style="font-weight:bold;padding-bottom:10px;display:inline-block;">Date: </span> {{$value->ticketType->event_start_date}}
                                    @else
                                        <span style="font-weight:bold;padding-bottom:10px;display:inline-block;">Date: </span> {{$attendee->event->event_start_date}}
                                    @endif
                                    <br/>
                                    @if($value->ticketType->start_time)
                                        <span style="font-weight:bold;">Time: </span> {{$value->ticketType->event_start_time}}
                                    @else
                                        <span style="font-weight:bold;">Time: </span> {{$attendee->event->event_start_time}}
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #ccc;padding: 10px;">
                                    <span style="font-weight:bold;padding-bottom:10px;display:inline-block;">Ticket Type: </span> {{$value->ticketType->ticket_name}}
                                    <br/>
                                    <span style="font-weight:bold;">Number of Tickets: </span> {{($key+1)}}
                                    of {{$attendee->ticket->count()}}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">
                                    <span style="font-weight:bold;">Ordered By: </span>{{$attendee->first_name}} {{$attendee->last_name}}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:40%;margin-top: 2px;">
                        <img style="margin-left: 38px;margin-top: 5px;"
                             src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('http://tickets.washingtonian.com/api/ticket/redeem/'.$attendee->id.$attendee->event->id.($key+1))) !!} "><br/>
                        <span style="display:block;float:right;font-size: 12px;padding: 0 2px 2px 0;color: #9c9c9c;">{{$attendee->id}}{{$attendee->event->id}}{{($key+1)}}</span>
                    </td>
                </tr>
            </table>
            <br/><br/><br/><br/>
            @if(($key+1) % 2 === 0 && ($key+1) != $attendee->ticket->count())
        </div>
    @endif
@endif
@endforeach

</body>
</html>