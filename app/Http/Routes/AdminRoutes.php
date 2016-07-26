<?php

use Illuminate\Support\Facades\Artisan;

$router->group(['middleware' => ['auth'], 'prefix' => 'admin'], function () use ($router) {

    $router->resource('users', 'Admin\UsersController');

    $router->resource('categories', 'Admin\CategoryController');

    $router->get('categories/moveup/{categories}', ['uses' => 'Admin\CategoryController@moveUp', 'as' => 'admin.categories.moveup']);
    $router->get('categories/movedown/{categories}', ['uses' => 'Admin\CategoryController@moveDown', 'as' => 'admin.categories.movedown']);
    $router->get('categories/removeimage/{categories}/{imageid}', ['uses' => 'Admin\CategoryController@removeImage', 'as' => 'admin.categories.removeimage']);


    $router->get('products/{products}/images', ['uses' => 'Admin\ProductController@loadImages', 'as' => 'admin.products.images.show']);
    $router->delete('products/{products}/deleteImage', ['uses' => 'Admin\ProductController@deleteImage', 'as' => 'admin.products.images.delete']);
    $router->resource('products', 'Admin\ProductController');
    $router->post('products/images/add', ['uses' => 'Admin\ProductController@addImage', 'as' => 'admin.products.images.add']);

    $router->get('/', function () {
        return redirect()->route('admin.products.index');
    });

    $router->get('refreshmedia', function () {
        Artisan::call('medialibrary:regenerate');

        return redirect()->back();
    });

});
