<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->app['Dingo\Api\Auth\Auth']->extend('oauth', function ($app) {
//            return new Dingo\Api\Auth\Provider\JWT($app['Tymon\JWTAuth\JWTAuth']);
//        });
//
//        $app['Dingo\Api\Http\RateLimit\Handler']->extend(function ($app) {
//            return new Dingo\Api\Http\RateLimit\Throttle\Authenticated;
//        });
    }

    /**
     * Register any application services.
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {

    }
}
