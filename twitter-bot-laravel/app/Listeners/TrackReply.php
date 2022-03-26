<?php

namespace App\Listeners;

use App\Events\TweetSent;
use App\Tracking;

class TrackReply
{
    protected $tracking;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Tracking $tracking)
    {
        $this->tracking = $tracking;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(TweetSent $event)
    {
        $this->tracking->create([
            'twitter_id' => $event->id,
        ]);
    }
}
