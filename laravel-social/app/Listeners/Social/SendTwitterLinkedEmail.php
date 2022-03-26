<?php

namespace App\Listeners\Social;

use App\Events\Social\TwitterAccountWasLinked;
use App\Mail\Social\TwitterAccountLinked;
use Mail;

class SendTwitterLinkedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param GitHubAccountWasLinked $event
     *
     * @return void
     */
    public function handle(TwitterAccountWasLinked $event)
    {
        Mail::to($event->user)->send(new TwitterAccountLinked($event->user));
    }
}
