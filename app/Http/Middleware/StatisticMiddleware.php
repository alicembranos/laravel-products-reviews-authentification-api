<?php

namespace App\Http\Middleware;

use App\Models\Endpoint;
use Closure;
use Illuminate\Http\Request;

class StatisticMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()) {
            return response()->json([
                'status' => false,
                'message' => 'You must to be logged in'
            ], 401);
        }
        $endpoint = new Endpoint();
        $endpoint->endpoint_name = $request->getPathInfo();
        $endpoint->user_id = $request->user()->id;
        $endpoint->save();

        $request->user()->endpoints()->save($endpoint);
        return $next($request);
    }
}
