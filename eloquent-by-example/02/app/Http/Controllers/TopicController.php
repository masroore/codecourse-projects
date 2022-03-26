<?php

namespace App\Http\Controllers;

use App\Topic;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::orderBy('created_at', 'desc')->get();

        // dd($topics->first()->user);

        return view('topic.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        return view('topic.show', compact('topic'));
    }
}
