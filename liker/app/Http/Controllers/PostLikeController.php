<?php

namespace App\Http\Controllers;

use App\Events\PostWasLiked;
use App\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('like', $post);

        $like = $post->likes()->firstOrNew([
            'user_id' => $request->user()->id,
        ]);

        if ($like->exists) {
            return response(null, 409);
        }

        $like->save();

        broadcast(new PostWasLiked($post, $request->user()))->toOthers();

        return response(null, 200);
    }
}
