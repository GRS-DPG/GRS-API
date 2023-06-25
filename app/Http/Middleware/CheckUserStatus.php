<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('api')->check() && Auth::guard('api')->user()->active_status == 1) {
            return $next($request);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Account deactivated.',
        ], 401);
    }
}
