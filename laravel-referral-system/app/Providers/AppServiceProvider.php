<?php

namespace App\Providers;

use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('referral', function ($token) {
            return Referral::whereToken($token)
                ->whereNotCompleted()
                ->whereNotFromUser(request()->user())
                ->first();
        });
    }
}
