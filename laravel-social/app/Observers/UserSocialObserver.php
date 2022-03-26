<?php

namespace App\Observers;

use App\UserSocial;

class UserSocialObserver
{
    public function created(UserSocial $userSocial)
    {

        $this->handleRegisteredEvent('created', $userSocial);
    }

    protected function handleRegisteredEvent($event, UserSocial $userSocial)
    {
        $class = config("social.events.{$userSocial->service}.{$event}", null);

        if (null === $class) {
            return;
        }

        event(new $class($userSocial->user()->first()));
    }
}
