<?php

namespace App\Http\Middleware;

use Closure;

class SubscribedPro
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->hasProSubscription()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->route('plans.index');
        }

        return $next($request);
    }
}
