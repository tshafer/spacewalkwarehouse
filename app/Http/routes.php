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

use App\Category;

$router->get('/', [
    'as'   => 'home',
    'uses' => 'HomeController@index',
]);

$router->get('/category/{category}', [
    'as'   => 'category',
    'uses' => 'CategoryController@index',
]);

$router->get('/category/{category}/{subcategory}', [
    'as'   => 'subcategory',
    'uses' => 'CategoryController@subCategory',
]);

$router->get('loggies', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

$router->model('users', App\User::class);
$router->model('categories', App\Category::class);

$router->bind('category', function($value){
    return Category::whereSlug($value)->first();
});

$router->bind('subcategory', function($value){
    return Category::whereSlug($value)->first();
});


$router->model('manufacturers', App\Manufacturer::class);

require 'Routes/AuthRoutes.php';
require 'Routes/AdminRoutes.php';

