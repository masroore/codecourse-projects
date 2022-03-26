<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }
}
