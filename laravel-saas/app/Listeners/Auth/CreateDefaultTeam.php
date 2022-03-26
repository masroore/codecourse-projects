<?php

namespace App\Listeners\Auth;

class CreateDefaultTeam
{
    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $event->user->team()->create([
            'name' => $event->user->name,
        ]);
    }
}
