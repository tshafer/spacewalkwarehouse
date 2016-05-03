<?php

// Authentication routes...

$router->get('auth/login', [
  'as'   => 'auth.login',
  'uses' => 'Auth\AuthController@getLogin',
]);

$router->post('auth/login', 'Auth\AuthController@postLogin');

$router->get('auth/logout', [
  'as'   => 'auth.logout',
  'uses' => 'Auth\AuthController@getLogout',
]);


// Registration routes...
$router->get('auth/register', 'Auth\AuthController@getRegister');
$router->post('auth/register', 'Auth\AuthController@postRegister');


// Password reset link request routes...
$router->get('password/email',
  [
    'as'   => 'auth.password',
    'uses' => 'Auth\RemindersController@getEmail',
  ]);

$router->post('password/email', 'Auth\RemindersController@postEmail');

// Password reset routes...
$router->get('password/reset/{token}', 'Auth\RemindersController@getReset');
$router->post('password/reset',
  [
    'as'   => 'auth.reset',
    'uses' => 'Auth\RemindersController@postReset',
  ]);