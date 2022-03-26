<?php

namespace App\Http\Middleware;

use Closure;

class SetReferralCookie
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, Closure $next)
    {
        if ($referral = $request->referral($request->referral)) {
            cookie()->queue(cookie()->forever('referral', $referral->token));
        }

        return $next($request);
    }
}
