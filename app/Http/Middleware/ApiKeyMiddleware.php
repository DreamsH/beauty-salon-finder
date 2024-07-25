<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header(config('app.api_key_header'));
        if (!$apiKey || $apiKey !== config('app.api_key')) {
            Log::error('API ERROR custom');
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
