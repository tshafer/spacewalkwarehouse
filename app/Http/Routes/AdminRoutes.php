<?php

$router->group(['middleware' => ['auth'], 'prefix' => 'admin'], function () use ($router) {

    $router->resource('users', 'Admin\UsersController');

    $router->get('/', function(){
        return redirect()->route('admin.users.index');
    });

});
