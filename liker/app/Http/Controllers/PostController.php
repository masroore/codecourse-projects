<?php

namespace App\Http\Controllers;

use App\Events\PostWasCreated;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request, Post $post)
    {
        return $post->with(['user'])->latestFirst()->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $post = $request->user()->posts()->create([
            'body' => $request->body,
        ]);

        broadcast(new PostWasCreated($post))->toOthers();

        return $post->load(['user']);
    }
}
