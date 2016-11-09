<?php

namespace ConsoleTVs\Apify;

use Illuminate\Support\ServiceProvider;

class ApifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/apify.php' => config_path('apify.php'),
        ], 'apify_config');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/api.php';
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/apify.php', 'apify'
        );
    }
}
