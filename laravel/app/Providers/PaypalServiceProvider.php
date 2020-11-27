<?php

namespace App\Providers;

use App\Services\PaypalAdapter;
use Illuminate\Support\ServiceProvider;

class PaypalServiceProvider extends ServiceProvider
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
        $this->app->singleton('payment.paypal', function ($app) {
            return new PaypalAdapter();
        });
    }
}
