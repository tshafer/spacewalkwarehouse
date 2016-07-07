<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        //Cache::forget('categories');
        //$categories = Cache::remember('categories', 10080, function () {
        $categories = Category::roots()->whereEnabled(1)->get();
        //});

        // Using Closure based composers...
        view()->composer('*', function ($view) use ($categories) {
            $view->with('categories', $categories);
        });
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}