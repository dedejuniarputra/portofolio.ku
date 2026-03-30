<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only count unique GET requests in 24 hours by IP
        if ($request->isMethod('GET') && !$request->ajax()) {
            $ip = $request->ip();
            $alreadyTracked = Visitor::where('ip_address', $ip)
                ->where('created_at', '>', now()->subHours(24))
                ->exists();

            if (!$alreadyTracked) {
                Visitor::create([
                    'ip_address' => $ip
                ]);
            }
        }
        
        return $next($request);
    }
}
