<?php
$router->model('users', Wash\User::class);
$router->model('events', Wash\Event::class);
$router->model('tickets', Wash\Ticket::class);
$router->model('coupons', Wash\Coupon::class);
$router->model('fitfests', Wash\FitFest::class);
$router->model('attendees', Wash\Attendee::class);
$router->model('fitclasses', Wash\FitClass::class);
$router->model('classtimes', Wash\ClassTime::class);
$router->model('tickettypes', Wash\TicketType::class);
$router->model('asktheexperts', Wash\AskTheExpert::class);

