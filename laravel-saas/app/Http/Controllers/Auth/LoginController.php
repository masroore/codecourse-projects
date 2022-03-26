<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasNotActivated()) {
            $this->guard()->logout();

            return back()->withError('Your account is not active.');
        }

        if ($user->twoFactorEnabled()) {
            return $this->startTwoFactorAuthentication($request, $user);
        }
    }

    protected function startTwoFactorAuthentication(Request $request, $user)
    {
        session()->put('twofactor', (object) [
            'user_id' => $user->id,
            'remember' => $request->has('remember'),
        ]);

        $this->guard()->logout();

        return redirect()->route('login.twofactor.index');
    }
}
