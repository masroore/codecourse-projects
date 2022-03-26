<?php

namespace App\Http\Controllers;

use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected $newsletter;

    public function __construct(NewsletterContract $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        try {
            $this->newsletter->subscribe(
                config('services.mailchimp.list'),
                $request->email
            );
        } catch (UserAlreadySubscribedException $e) {
            return redirect()->back()->withInput()->withErrors([
                'email' => $e->getMessage(),
            ]);
        }

        return redirect()->back();
    }
}
