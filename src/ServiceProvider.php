<?php

namespace Armincms\Mooncoffee;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider; 

class ServiceProvider extends LaravelServiceProvider implements DeferrableProvider
{ 

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
        $this->app->booted(function() { 
            app('site')->get('store')->component('product')->config([
                'layout' => 'clarity'
            ]);
        });
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
            \Core\HttpSite\Events\ServingFront::class,
            \Illuminate\Console\Events\ArtisanStarting::class,
        ];
    }
}
