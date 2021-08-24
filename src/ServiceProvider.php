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
            tap(app('site')->get('store'), function($store) {
                $store->component('product')->config([
                    'layout' => 'clarity'
                ]);
                $store->component('cart')->config([
                    'layout' => 'akuatik'
                ]);
                $store->component('shipping')->config([
                    'layout' => 'audacity'
                ]); 
                $store->component('dashboard')->config([
                    'layout' => 'myriad'
                ]);
                $store->component('login')->config([
                    'layout' => 'myriad-login'
                ]);
            });  
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
