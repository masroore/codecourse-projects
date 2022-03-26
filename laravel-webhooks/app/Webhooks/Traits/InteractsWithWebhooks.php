<?php

namespace App\Webhooks\Traits;

use ReflectionClass;

trait InteractsWithWebhooks
{
    public function getWebhookName()
    {
        return snake_case((new ReflectionClass($this))->getShortName());
    }
}
