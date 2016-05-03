<?php

use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;
use Wash\Attendee;
use Wash\Event;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('event/{event}', ['as' => 'event.show', 'uses' => 'Wash\Http\Controllers\Api\EventController@show']);

    $api->post('attendee',
      ['as' => 'attendee.create', 'uses' => 'Wash\Http\Controllers\Api\ProcessAttendeeController@create']);

    $api->post('coupon',
      ['as' => 'coupon.check', 'uses' => 'Wash\Http\Controllers\Api\ProcessAttendeeController@checkCouponCode']);

    $api->post('ticket/redeem',
      ['as' => 'ticket.redeem', 'uses' => 'Wash\Http\Controllers\Api\ProcessTicketController@handlePost']);

    $api->get('ticket/redeem/{ticket_id}',
      ['as' => 'ticket.redeem', 'uses' => 'Wash\Http\Controllers\Api\ProcessTicketController@handleGet']);

});

$router->get('send', function () {
    $attendee = Attendee::find(18);


    $pdf = Pdf::loadView('api.ticket', compact('attendee'));
    return $pdf->stream();

    Mail::send('emails.tickets', ['attendee' => $attendee], function ($m) use ($attendee, $ticket) {
        $m->to('tj@tjshafer.com', $attendee->name)->subject('Your Tickets!');
        $m->attach($ticket);
    });
});
/**
 * @Todo
 * Convert to real api responses
 */
$router->get('api/asktheexperts/{id}', function ($id) {
    return view("frontend.asktheexperts." . $id)->render();
});

$router->post('api/tickets/{id}', function ($id) {
    return view("frontend.asktheexperts." . $id)->render();
});

$router->get('fitfest/class/{fitclass}', function ($id) {
    $class = \Wash\FitClass::find($id);

    if ( ! $class) {
        return null;
    }

    return $class->max_students - $class->students->count();
});