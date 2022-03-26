<?php

namespace App\Providers;

use App\Spam\Service\AkismetSpamService;
use App\Spam\Service\SpamServiceInterface;
use Illuminate\Support\ServiceProvider;

class SpamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SpamServiceInterface::class, function ($app) {
            return new AkismetSpamService(new \GuzzleHttp\Client());
        });
    }
}
