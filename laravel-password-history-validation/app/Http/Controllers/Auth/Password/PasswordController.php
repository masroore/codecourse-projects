<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Rules\NotFromPasswordHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
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
        return view('auth.passwords.change');
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => [
                'required',
                new NotFromPasswordHistory($request->user(), 5),
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->withStatus('Your password was changed');
    }
}
