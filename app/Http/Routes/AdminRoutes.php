<?php

use Illuminate\Support\Facades\Artisan;

$router->group(['middleware' => ['auth'], 'prefix' => 'admin'], function () use ($router) {

    $router->resource('users', 'Admin\UsersController');

    $router->resource('categories', 'Admin\CategoryController');

    $router->get('categories/moveup/{categories}', ['uses' => 'Admin\CategoryController@moveUp', 'as' => 'admin.categories.moveup']);
    $router->get('categories/movedown/{categories}', ['uses' => 'Admin\CategoryController@moveDown', 'as' => 'admin.categories.movedown']);
    $router->get('categories/removeimage/{categories}/{imageid}', ['uses' => 'Admin\CategoryController@removeImage', 'as' => 'admin.categories.removeimage']);

    $router->resource('manufacturers', 'Admin\ManufacturersController');
    $router->get('manufacturers/removeimage/{manufacturers}/{imageid}', ['uses' => 'Admin\ManufacturersController@removeImage', 'as' => 'admin.manufacturers.removeimage']);

    $router->get('/', function () {
        return redirect()->route('admin.users.index');
    });

    $router->get('refreshmedia', function ()
    {

        Artisan::call('medialibrary:regenerate');

        return redirect()->back();
    });

});
