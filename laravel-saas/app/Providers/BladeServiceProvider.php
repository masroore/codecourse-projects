<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('impersonating', function () {
            return session()->has('impersonate');
        });

        Blade::if('admin', function () {
            return auth()->user()->hasRole('admin');
        });

        Blade::if('subscribed', function () {
            return auth()->user()->hasSubscription();
        });

        Blade::if('notsubscribed', function () {
            return !auth()->check() || auth()->user()->doesNotHaveSubscription();
        });

        Blade::if('subscriptioncancelled', function () {
            return auth()->user()->hasCancelled();
        });

        Blade::if('subscriptionnotcancelled', function () {
            return auth()->user()->hasNotCancelled();
        });

        Blade::if('teamsubscription', function () {
            return auth()->user()->hasTeamSubscription();
        });

        Blade::if('notpiggybacksubscription', function () {
            return !auth()->user()->hasPiggybackSubscription();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
