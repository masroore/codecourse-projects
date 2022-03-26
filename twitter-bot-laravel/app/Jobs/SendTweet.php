<?php

namespace App\Jobs;

use App\Events\TweetSent;
use App\Services\Twitter\TwitterService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTweet extends Job implements ShouldQueue
{
    use InteractsWithQueue;
    use SerializesModels;

    public $id;

    public $handle;

    public $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $handle, $text)
    {
        $this->id = $id;
        $this->handle = $handle;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TwitterService $twitter)
    {
        $twitter->sendTweet("@{$this->handle} {$this->text}", $this->id);

        event(new TweetSent($this->id));
    }
}
