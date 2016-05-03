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
use App\Attendee;


$router->get('loggies', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

$router->model('users', App\User::class);
$router->model('events', App\Event::class);
$router->model('tickets', App\Ticket::class);
$router->model('coupons', App\Coupon::class);
$router->model('fitfests', App\FitFest::class);
$router->model('attendees', App\Attendee::class);
$router->model('fitclasses', App\FitClass::class);
$router->model('classtimes', App\ClassTime::class);
$router->model('tickettypes', App\TicketType::class);
$router->model('asktheexperts', App\AskTheExpert::class);

require 'Routes/AuthRoutes.php';
require 'Routes/AdminRoutes.php';

