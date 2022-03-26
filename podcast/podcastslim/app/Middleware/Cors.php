<?php

namespace App\Middleware;

class Cors
{
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);

        return $response->withHeader('Access-Control-Allow-Origin', getenv('CLIENT_URL'))
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
