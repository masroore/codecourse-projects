<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->body = 'Hello there';
        $post->user()->associate($request->user());

        if ($post->isSpam()) {

        }

        $post->save();
    }

    public function spam(Post $post)
    {
        $post->markAsSpam();

        $post->spam = true;
        $post->save();
    }

    public function ham(Post $post)
    {
        $post->markAsHam();

        $post->spam = false;
        $post->save();
    }
}
