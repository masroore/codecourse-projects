<?php

namespace App\Http\Controllers\Auth;

use App\Auth\MagicAuthentication;
use App\Http\Controllers\Controller;
use App\UserLoginToken;
use Auth;
use Illuminate\Http\Request;

class MagicLoginController extends Controller
{
    protected $redirectOnRequested = '/login/magic';

    public function show()
    {
        return view('auth.magic.login');
    }

    public function sendToken(Request $request, MagicAuthentication $auth)
    {
        $this->validateLogin($request);

        $auth->requestLink();

        return redirect()->to($this->redirectOnRequested)->with('success', 'We\'ve sent you a magic link!');
    }

    public function validateToken(Request $request, UserLoginToken $token)
    {
        $token->delete();

        if ($token->isExpired()) {
            return redirect('/login/magic')->with('error', 'That magic link has expired.');
        }

        if (!$token->belongsToEmail($request->email)) {
            return redirect('/login/magic')->with('error', 'Invalid magic link.');
        }

        Auth::login($token->user, $request->remember);

        return redirect()->intended();
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users,email',
        ]);
    }
}
