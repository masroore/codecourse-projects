<?php

namespace App\Webhooks\Listeners;

use App\Webhooks\Events\WebhookEvent;
use App\Webhooks\Jobs\FireWebhook;

class WebhookEventSubscriber
{
    public function subscribe($events)
    {
        $events->listen('*', self::class . '@handle');
    }

    public function handle($event, $data)
    {
        if (!($event = head($data)) instanceof WebhookEvent) {
            return;
        }

        $event->webhookOwner()->webhooks->each(function ($webhook) use ($event) {
            if (!$webhook->enabledFor($event->getWebhookName())) {
                return;
            }

            dispatch(new FireWebhook($event, $webhook))->onQueue('webhooks');
        });
    }
}
