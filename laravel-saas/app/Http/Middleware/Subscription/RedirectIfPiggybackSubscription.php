<?php

namespace App\Http\Middleware\Subscription;

use Closure;

class RedirectIfPiggybackSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->hasPiggybackSubscription()) {
            return redirect()->route('account.index');
        }

        return $next($request);
    }
}
