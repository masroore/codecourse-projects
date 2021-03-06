<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->hasRole('admin')) {
            return abort(404);
        }

        return $next($request);
    }
}
