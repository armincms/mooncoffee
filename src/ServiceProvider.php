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
            app('site')->get('store')->component('cart')->config([
                'layout' => 'akuatik'
            ]);
            app('site')->get('store')->component('shipping')->config([
                'layout' => 'audacity'
            ]);
        });

        $this->app->afterResolving('conversion', function($manager) {
            $product = $manager->driver('product');
            $product->merge('thumbnail', [
                'width' => 350,
                'height' => 350,
            ]);
            $product->merge('mid', [
                'width' => 500,
                'height' => 500,
            ]);
            $product->merge('larg', [
                'width' => 633,
                'height' => 633,
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
