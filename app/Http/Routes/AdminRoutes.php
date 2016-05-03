<?php

$router->group([ 'middleware' => [ 'auth' ], 'prefix' => 'admin' ], function () use ($router) {

    $router->get('/', [
        'as'   => 'fitfest.index',
        'uses' => 'Admin\FitFestsController@index',
    ]);

    $router->resource('reports', 'Admin\ReportsController', [
            'name' => 'reports',
        ]);

    $router->resource('fitfests', 'Admin\FitFestsController', [
            'except' => [ 'create', 'store', 'edit', 'update' ],
            'name'   => 'fitfest',
        ]);

    $router->resource('attendees', 'Admin\AttendeesController', [
            'except' => [ 'create', 'store', 'edit', 'update' ],
            'name'   => 'attendees',
        ]);

    $router->resource('asktheexperts', 'Admin\AskTheExpertsController', [
            'except' => [ 'create', 'store', 'edit', 'update' ],
            'name'   => 'asktheexperts',
        ]);

    $router->resource('fitclasses', 'Admin\FitClassesController', [
            'except' => [ 'create', 'store', 'edit', 'update' ],
            'name'   => 'classes',
        ]);

    $router->resource('users', 'Admin\UsersController', [
            'except' => [ ],
            'name'   => 'admin.users',
        ]);

    $router->resource('events', 'Admin\EventsController', [
            'except' => [ ],
            'name'   => 'admin.events',
        ]);

    $router->get('events/checkin/{events}', [
            'uses' => 'Admin\EventsController@checkin',
            'as'   => 'admin.events.checkin',
        ]);

    $router->get('events/export/{events}', [
        'uses' => 'Admin\EventsController@export',
        'as'   => 'admin.events.export',
    ]);
    $router->post('events/checkin/process', [
            'uses' => 'Admin\EventsController@process',
            'as'   => 'admin.events.checkin.process',
        ]);

    $router->resource('coupons', 'Admin\CouponsController', [
            'except' => [ 'edit', 'update' ],
            'name'   => 'admin.coupons',
        ]);

    $router->resource('tickettypes', 'Admin\TicketTypesController', [
            'name' => 'admin.tickettypes',
        ]);
});
