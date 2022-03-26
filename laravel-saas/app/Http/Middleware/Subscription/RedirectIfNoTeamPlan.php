<?php

namespace App\Http\Middleware\Subscription;

use Closure;

class RedirectIfNoTeamPlan
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->doesNotHaveTeamSubscription()) {
            return redirect()->route('account.index');
        }

        return $next($request);
    }
}
