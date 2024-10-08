<?php

namespace App\Http\Middleware;

use App\Models\ApiLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true);

        $response = $next($request);

        $end = microtime(true);

        ApiLog::query()->create([
            'method' => $request->method(),
            'endpoint' => $request->path(),
            'statusCode' => $response->getStatusCode(),
            'requestParameters' => json_encode($request->all()),
            'responseTime' => round(($end - $start) * 1000, 2),
        ]);

        return $response;
    }
}
