<?php

namespace App\Events;

use App\Webhooks\Events\WebhookEvent;
use App\Webhooks\Models\WebhookOwner;
use App\Webhooks\Traits\InteractsWithWebhooks;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoEncoded implements WebhookEvent
{
    use Dispatchable;
    use InteractsWithWebhooks;
    use SerializesModels;

    /**
     * [$user description].
     *
     * @var [type]
     */
    public $owner;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(WebhookOwner $owner)
    {
        $this->owner = $owner;
    }

    public function webhookOwner()
    {
        return $this->owner;
    }

    public function webhookPayload()
    {
        return [
            'value' => true,
        ];
    }
}
