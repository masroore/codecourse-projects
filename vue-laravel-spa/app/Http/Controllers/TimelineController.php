<?php

namespace App\Http\Controllers;

class TimelineController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => 'Timeline index',
        ], 200);
    }
}
