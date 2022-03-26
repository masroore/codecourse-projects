<?php

namespace App\Listeners\Social;

use App\Events\Social\GitHubAccountWasLinked;
use App\Mail\Social\GitHubAccountLinked;
use Mail;

class SendGitHubLinkedEmail
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
     * @return void
     */
    public function handle(GitHubAccountWasLinked $event)
    {
        Mail::to($event->user)->send(new GitHubAccountLinked($event->user));
    }
}
