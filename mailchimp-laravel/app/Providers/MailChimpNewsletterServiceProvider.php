<?php

namespace App\Providers;

use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\MailChimpNewsletter;
use Illuminate\Support\ServiceProvider;
use Mailchimp;

class MailChimpNewsletterServiceProvider extends ServiceProvider
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
        $this->app->singleton(NewsletterContract::class, function ($app) {
            $client = new Mailchimp($app->config->get('services.mailchimp.secret'));

            return new MailChimpNewsletter($client);
        });
    }
}
