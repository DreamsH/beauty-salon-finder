<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CronAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the client's IP address
        $clientIp = $request->ip();

        // Check if the IP address is localhost
        if ($clientIp == config("app.cron_allowed_ip")) {
            return $next($request);
        }

        // If not from localhost, return a 403 Forbidden response
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
