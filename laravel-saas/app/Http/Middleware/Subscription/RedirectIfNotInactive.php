<?php

namespace App\Http\Middleware\Subscription;

use Closure;

class RedirectIfNotInactive
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->hasSubscription()) {
            return redirect()->route('account.index');
        }

        return $next($request);
    }
}
