<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class SocialiteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return $app->make('Laravel\Socialite\Factory');
        });
    }

    public function boot()
    {
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('google', function () use ($socialite) {
            $config = config('services.google');

            return $socialite->buildProvider(
                \Laravel\Socialite\Two\GoogleProvider::class,
                $config
            );
        });
    }
}