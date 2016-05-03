<?php

$router->get('/', function() {
  return abort(503);
});

$router->resource('fitfest', 'Frontend\FitFestsController',
  [
    'only' => ['index', 'store'],
    'name' => 'fitfest',
  ]);

$router->get('fitfest/thanks', [
  'as'   => 'fitfest.thanks',
  'uses' => 'Frontend\FitFestsController@thanks',
]);

$router->get('fitfest/export', [
  'as'   => 'fitfest.export',
  'uses' => 'Frontend\FitFestsController@export',
]);

