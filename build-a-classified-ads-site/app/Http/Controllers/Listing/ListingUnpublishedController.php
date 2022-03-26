<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingUnpublishedController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $listings = $request->user()->listings()->with(['area'])->isNotLive()->latestFirst()->paginate(10);

        return view('user.listings.unpublished.index', compact('listings'));
    }
}
