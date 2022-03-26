<?php

namespace App\Http\Controllers\Listing;

use App\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreListingContactFormRequest;
use App\Listing;
use App\Mail\ListingContactCreated;
use Mail;

class ListingContactController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function store(StoreListingContactFormRequest $request, Area $area, Listing $listing)
    {
        Mail::to($listing->user)->queue(
            new ListingContactCreated($listing, $request->user(), $request->message)
        );

        return back()->withSuccess("We have sent your message to {$listing->user->name}");
    }
}
