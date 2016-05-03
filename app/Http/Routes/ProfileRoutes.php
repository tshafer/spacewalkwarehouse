<?php

$router->get('/', [
  'as'   => 'asktheexperts.index',
  'uses' => 'Frontend\AskTheExpertsController@index',
]);

$router->resource('asktheexperts', 'Frontend\AskTheExpertsController',
  [
    'only' => ['index', 'store'],
    'name' => 'asktheexperts',
  ]);

$router->get('asktheexperts/thanks', [
  'as'   => 'asktheexperts.thanks',
  'uses' => 'Frontend\AskTheExpertsController@thanks',
]);

