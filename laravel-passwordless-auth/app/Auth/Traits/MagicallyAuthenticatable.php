<?php

namespace App\Auth\Traits;

use App\Mail\MagicLoginRequested;
use App\UserLoginToken;
use Mail;

trait MagicallyAuthenticatable
{
    public function storeToken()
    {
        $this->token()->delete();

        $this->token()->create([
            'token' => str_random(255),
        ]);

        return $this;
    }

    public function sendMagicLink(array $options)
    {
        Mail::to($this)->send(new MagicLoginRequested($this, $options));
    }

    public function token()
    {
        return $this->hasOne(UserLoginToken::class);
    }
}
