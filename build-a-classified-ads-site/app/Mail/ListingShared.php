<?php

namespace App\Mail;

use App\Listing;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ListingShared extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $listing;

    public $sender;

    public $body;

    /**
     * Create a new message instance.
     *
     * @param mixed|null $body
     *
     * @return void
     */
    public function __construct(Listing $listing, User $sender, $body = null)
    {
        $this->listing = $listing;
        $this->sender = $sender;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('email.listing.shared.message')
            ->subject("{$this->sender->name} shared a listing with you.")
            ->from('hello@fresh.com');
    }
}
