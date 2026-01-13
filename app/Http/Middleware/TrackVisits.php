<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Simple Bot Filtering (Primitive)
        $userAgent = $request->header('User-Agent');
        if (strpos($userAgent, 'bot') !== false || strpos($userAgent, 'crawl') !== false) {
             return $next($request);
        }

        // Track Visit
        // To avoid spamming DB, we could check if ip exists today
        // But for this simple portfolio, logging every hit is fine for "Page Views"
        \App\Models\Visit::create([
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'user_agent' => $userAgent,
        ]);

        return $next($request);
    }
}
