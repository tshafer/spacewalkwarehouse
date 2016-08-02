<?php

use Illuminate\Support\Facades\Artisan;

$router->group(['middleware' => ['auth'], 'prefix' => 'admin'], function () use ($router) {

    $router->resource('users', 'Admin\UsersController');

    $router->get('specials/{specials}/image/{imageid}/delete', ['uses' => 'Admin\SpecialsController@deleteImage', 'as' => 'admin.specials.image.delete']);
    $router->resource('specials', 'Admin\SpecialsController');
    
    $router->get('sliders/removeimage/{sliders}/{imageid}', ['uses' => 'Admin\SlidersController@deleteImage', 'as' => 'admin.sliders.image.delete']);
    $router->resource('sliders', 'Admin\SlidersController');


    $router->resource('units', 'Admin\UnitController');

    $router->resource('unitrequests', 'Admin\RequestsController',  ['except' => ['create', 'edit', 'store', 'update']]);


    $router->get('categories/moveup/{categories}', ['uses' => 'Admin\CategoryController@moveUp', 'as' => 'admin.categories.moveup']);
    $router->get('categories/movedown/{categories}', ['uses' => 'Admin\CategoryController@moveDown', 'as' => 'admin.categories.movedown']);
    $router->get('categories/{categories}/images/{imageid}/delete', ['uses' => 'Admin\CategoryController@deleteImage', 'as' => 'admin.categories.image.delete']);
    $router->resource('categories', 'Admin\CategoryController');

    $router->get('products/{products}/image/{imageid}/default', ['uses' => 'Admin\ProductController@defaultImage', 'as' => 'admin.products.images.default']);
    $router->get('products/{products}/image/{imageid}/delete', ['uses' => 'Admin\ProductController@deleteImage', 'as' => 'admin.products.images.delete']);
    $router->get('products/{products}/image/{imageid}/accessories/delete', ['uses' => 'Admin\ProductController@deleteAccessoryImage', 'as' => 'admin.products.images.accessories.delete']);
    $router->post('products/{products}/images/add', ['uses' => 'Admin\ProductController@addImage', 'as' => 'admin.products.images.add']);
    $router->post('products/{products}/images/accessories/add', ['uses' => 'Admin\ProductController@addAccessoryImage', 'as' => 'admin.products.images.accessories.add']);
    $router->resource('products', 'Admin\ProductController');

    $router->get('/', function () {
        return redirect()->route('admin.products.index');
    });

    $router->get('refreshmedia', function () {
        Artisan::call('medialibrary:regenerate');

        return redirect()->back();
    });

});
