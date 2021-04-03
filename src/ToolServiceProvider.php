<?php

namespace Armincms\Store;
 
use Illuminate\Support\ServiceProvider as LaravelServiceProvider; 
use Laravel\Nova\Nova as LaravelNova; 

class ServiceProvider extends LaravelServiceProvider implements DeferrableProvider
{ 

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        LaravelNova::resources([
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [
            \Laravel\Nova\Events\ServingNova::class,
            \Illuminate\Console\Events\ArtisanStarting::class,
        ];
    }
}
