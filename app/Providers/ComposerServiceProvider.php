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

        $menu = Cache::rememberForever('menu', function () {
            return Category::roots()->whereEnabled(1)->get();
        });

        // Using Closure based composers...
        view()->composer('*', function ($view) use ($menu) {
            $view->with('categories', $menu);
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