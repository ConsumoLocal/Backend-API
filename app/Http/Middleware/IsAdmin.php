<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()->isAdmin($request->user()->id)) {
            return response()->json(['error' => 'You are required to be an admin to perform this operation'], 403);
        }
        return $next($request);
    }
}
