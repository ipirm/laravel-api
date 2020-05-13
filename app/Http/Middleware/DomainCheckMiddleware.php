<?php

namespace App\Http\Middleware;

use Closure;

class DomainCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        $allowedHosts = explode(',', env('ALLOWED_DOMAINS'));

        $requestHost = parse_url($request->headers->get('origin'),  PHP_URL_HOST);


        return $next($request);
    }
}
