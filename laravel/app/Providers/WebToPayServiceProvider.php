<?php

namespace App\Providers;
use App\Services\WebToPayAdapter;
use Illuminate\Support\ServiceProvider;

class WebToPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('payment.paysera', function ($app) {
            return new WebToPayAdapter();
        });
    }
}
