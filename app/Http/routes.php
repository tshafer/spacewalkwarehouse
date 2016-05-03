<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Knp\Snappy\Pdf;
use Wash\Attendee;

$router->get('test', function () {

    return view('test');
});
$router->get('testlocal', function () {

    return view('testlocal');
});

$router->get('testlocal2', function () {

    return view('testlocal2');
});

$router->get('loggies', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

require 'Routes/Models.php';
require 'Routes/ApiRoutes.php';
require 'Routes/AuthRoutes.php';
require 'Routes/AdminRoutes.php';

if (app()->environment() == 'local') {
    require 'Routes/ProfileRoutes.php';
    require 'Routes/FitfestRoutes.php';
} else {

    $router->group([ 'domain' => 'profiles.washingtonian.com' ], function () use ($router) {
        require 'Routes/ProfileRoutes.php';
    });

    $router->group([ 'domain' => 'tickets.washingtonian.com' ], function () use ($router) {
        require 'Routes/FitfestRoutes.php';
    });
}

//$router->get('fixtickets', function () {
//
//    $attendees = Attendee::whereEventId(3)->get();
//
//    foreach ($attendees as $attendee) {
//
//        $pdf         = Barryvdh\Snappy\Facades\SnappyPdf::loadView('api.ticket', compact('attendee'));
//        $ticket_name = $attendee->first_name . '_' . $attendee->last_name . '_' . time() . '.pdf';
//        $ticket      = public_path() . '/uploads/events/' . $ticket_name;
//        $pdf->save($ticket);
//
//        /** @var Save Ticket ticket_path */
//        $attendee->ticket_path = $ticket_name;
//        $attendee->save();
//
//        Mail::send('emails.ticketsfix', ['data' => $attendee], function ($m) use ($attendee, $ticket) {
//            $m->to($attendee->email, $attendee->name)->subject('Your new Unveiled tickets!');
//            //$m->to('pthorton@washingtonian.com', $attendee->name)->subject('Your Tickets!');
//            $m->to('tshafer@washingtonian.com', $attendee->name)->subject('Your new Unveiled tickets!');
//
//            $m->attach($ticket);
//        });
//        echo  $attendee->first_name . '_' . $attendee->last_name.'<br/>';
//
//    }
//
//});
