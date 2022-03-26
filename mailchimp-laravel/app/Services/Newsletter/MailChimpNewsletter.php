<?php

namespace App\Services\Newsletter;

use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;
use Mailchimp;
use Mailchimp_List_AlreadySubscribed;

class MailChimpNewsletter implements NewsletterContract
{
    protected $client;

    public function __construct(Mailchimp $client)
    {
        $this->client = $client;
    }

    public function subscribe($listId, $email, $mergeVars = [])
    {
        try {
            $this->client->lists->subscribe($listId, [
                'email' => $email,
            ], $mergeVars);
        } catch (Mailchimp_List_AlreadySubscribed $e) {
            throw new UserAlreadySubscribedException();
        }
    }
}
