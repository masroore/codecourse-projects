<?php

namespace App\Webhooks\Jobs;

use App\Webhook;
use App\Webhooks\Events\WebhookEvent;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FireWebhook implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * [$tries description].
     *
     * @var int
     */
    public $tries = 3;

    /**
     * [$event description].
     *
     * @var [type]
     */
    public $event;

    /**
     * [$webhook description].
     *
     * @var [type]
     */
    public $webhook;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WebhookEvent $event, Webhook $webhook)
    {
        $this->event = $event;
        $this->webhook = $webhook;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Client $client)
    {
        $event = $this->event;
        $webhook = $this->webhook;

        try {
            $response = $client->request($webhook->verb, $webhook->url, [
                'json' => [
                    'event' => $event->getWebhookName(),
                    'data' => $event->webhookPayload(),
                ],
            ]);
        } catch (Exception $e) {
            // log failure
            throw $e;
        }
    }
}
