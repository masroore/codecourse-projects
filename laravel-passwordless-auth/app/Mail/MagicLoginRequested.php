<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagicLoginRequested extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;

    public $options;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, array $options)
    {
        $this->user = $user;
        $this->options = $options;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your magic login link')->view('email.auth.magic.link')->with([
            'link' => $this->buildLink(),
        ]);
    }

    protected function buildLink()
    {
        return url('/login/magic/' . $this->user->token->token . '?' . http_build_query($this->options));
    }
}
