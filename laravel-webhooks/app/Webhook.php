<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    public function enabledFor($preference)
    {
        return true === optional($this->preferences)->{$preference};
    }

    public function preferences()
    {
        return $this->hasOne(WebhookPreference::class);
    }
}
