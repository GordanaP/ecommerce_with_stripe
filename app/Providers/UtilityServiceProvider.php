<?php

namespace App\Providers;

use App\Services\Utilities\Calculator;
use Illuminate\Support\ServiceProvider;

class UtilityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Register a binding of a class with a related container.
         */
        $this->app->bind('calculator', function() {
            return new Calculator();
        });
    }
}
