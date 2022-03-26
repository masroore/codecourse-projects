<?php

namespace App\Http\Controllers;

use App\Room;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rooms = Room::get();

        return view('chat', compact('rooms'));
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function show(Room $room)
    {
        $messages = $room->messages()->with(['user'])->latest()->get();

        return view('chat.room', compact('room', 'messages'));
    }
}
