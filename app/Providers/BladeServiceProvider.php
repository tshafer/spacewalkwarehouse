<?php

namespace Wash\Providers;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        /* @datetime($time) */
        Blade::directive('datetime', function ($expression) {
            return "<?php echo with{$expression}->format('m/d/Y H:i'); ?>";
        });


    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}