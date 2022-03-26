<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetLikesWereUpdated;
use App\Http\Controllers\Controller;
use App\Notifications\Tweets\TweetLiked;
use App\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:airlock']);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function store(Tweet $tweet, Request $request)
    {
        if ($request->user()->hasLiked($tweet)) {
            return response(null, 409);
        }

        $request->user()->likes()->create([
            'tweet_id' => $tweet->id,
        ]);

        if ($request->user()->id !== $tweet->user_id) {
            $tweet->user->notify(new TweetLiked($request->user(), $tweet));
        }

        broadcast(new TweetLikesWereUpdated($request->user(), $tweet));
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function destroy(Tweet $tweet, Request $request)
    {
        $request->user()->likes->where('tweet_id', $tweet->id)->first()->delete();

        broadcast(new TweetLikesWereUpdated($request->user(), $tweet));
    }
}
