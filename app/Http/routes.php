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

$router->get('/', [
  'as'   => 'home',
  'uses' => 'HomeController@index',
]);

$router->get('loggies', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

$router->model('users', App\User::class);


require 'Routes/AuthRoutes.php';
require 'Routes/AdminRoutes.php';

