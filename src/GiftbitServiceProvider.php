<?php

namespace WFX\Giftbit;

use Illuminate\Support\ServiceProvider;
use WFX\Giftbit\Giftbit;

class GiftbitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/giftbit.php', 'giftbit');

        // Register the service the package provides.
        $this->app->singleton('giftbit', function ($app) {
            return new Giftbit;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['giftbit'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/giftbit.php' => config_path('giftbit.php'),
        ], 'giftbit.config');

    }
}
