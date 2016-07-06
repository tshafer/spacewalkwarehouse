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

$router->get('/contact', [
    'as'   => 'contact',
    'uses' => 'SiteController@contact',
]);

$router->post('/contact', [
    'as'   => 'contact.post',
    'uses' => 'SiteController@contactPost',
]);

$router->get('/outdoor-furniture-cleveland', [
    'uses' => 'SiteController@outdoorFurnitureCleveland',
]);

$router->get('/cleveland-patio-deck-furniture/{id}/{slug}', [
    'uses' => 'SiteController@outdoorFurnitureClevelandIndividual',
    'as' => 'cleveland-patio-deck-furniture'
]);

$router->get('/category/{category}', [
    'as'   => 'category',
    'uses' => 'CategoryController@index',
]);

$router->get('/category/{category}/{subcategory}', [
    'as'   => 'subcategory',
    'uses' => 'CategoryController@subCategory',
]);

$router->get('/category/{category}/{subcategory}/{product}', [
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
$router->model('manufacturers', App\Manufacturer::class);

/**
 * Frontend Model Binding
 */
$router->bind('category', function($value){
    return Category::whereSlug($value)->with('media')->first();
});

$router->bind('subcategory', function($value){
    return Category::whereSlug($value)->with('media')->first();
});

$router->bind('product', function($value){
    return Product::whereSlug($value)->with('media')->first();
});


/**
 * Admin and Auth Routes
 */
require 'Routes/AuthRoutes.php';
require 'Routes/AdminRoutes.php';

