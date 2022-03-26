<?php

namespace App\Console\Commands;

use App\Common\EmojiHelper;
use App\Jobs\SendTweet;
use App\Services\Twitter\Exceptions\RateLimitExceededException;
use App\Services\Twitter\TwitterService;
use App\Tracking;
use Illuminate\Console\Command;

class ReplyToTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sentibot:reply';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replies to recent mentions.';

    protected $twitter;

    protected $ml;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TwitterService $twitter)
    {
        parent::__construct();
        $this->twitter = $twitter;
        $this->ml = app()->make('monkeylearn');
    }

    /**
     * Execute the console command.
     */
    public function handle(Tracking $tracking, EmojiHelper $emojis)
    {
        $tracked = $tracking->latestFirst();

        try {
            $mentions = $this->twitter->getMentions($tracked->count() ? $tracked->first()->twitter_id : null);
        } catch (RateLimitExceededException $e) {
            return $this->error('Twitter rate limit exceeded');
        }

        if (!$mentions->count()) {
            return $this->info('No mentions to process.');
        }

        $text = $mentions->map(function ($mention) {
            return $mention->text;
        });

        $sentiments = $this->ml->classifiers->classify('cl_qkjxv9Ly', $text->toArray(), true);

        $mentions->each(function ($mention, $index) use ($sentiments, $emojis) {
            dispatch(new SendTweet(
                $mention->id,
                $mention->user->screen_name,
                $emojis->random($sentiments->result[$index][0]['label'])
            ));
        });
    }
}
