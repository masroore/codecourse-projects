<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTopicController extends Controller
{
    public function index(Request $request)
    {
        $topics = $request->user()->topics()->orderBy('created_at', 'desc')->get();

        return view('user.topics.index', compact('topics'));
    }
}
