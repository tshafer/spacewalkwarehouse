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
use App\Product;

/**
 * Site Routes
 */
$router->get('/', [
    'as'   => 'home',
    'uses' => 'SiteController@index',
]);

$router->get('about', [
    'as'   => 'about',
    'uses' => 'SiteController@about',
]);

$router->get('privacy', [
    'as'   => 'privacy',
    'uses' => 'SiteController@privacy',
]);

$router->get('terms', [
    'as'   => 'terms',
    'uses' => 'SiteController@termsConditions',
]);


$router->get('/contact', [
    'as'   => 'contact',
    'uses' => 'SiteController@contact',
]);

$router->post('/contact', [
    'as'   => 'contact.post',
    'uses' => 'SiteController@contactPost',
]);

$router->get('/category/{category}', [
    'as'   => 'category',
    'uses' => 'CategoryController@index',
]);


$router->get('/category/{category}/{product}', [
    'as'   => 'product',
    'uses' => 'ProductController@show',
]);



$router->get('loggies', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

/**
 * Generic Model Binding
 */
$router->model('users', App\User::class);
$router->model('products', App\Product::class);
$router->model('categories', App\Category::class);

/**
 * Frontend Model Binding
 */
$router->bind('category', function($value){
    return Category::whereSlug($value)->first();
});

$router->bind('subcategory', function($value){
    return Category::whereSlug($value)->first();
});

$router->bind('product', function($value){
    return Product::whereSlug($value)->first();
});


/**
 * Admin and Auth Routes
 */
require 'Routes/AuthRoutes.php';
require 'Routes/AdminRoutes.php';

