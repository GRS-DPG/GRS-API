<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppLogin
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

    if ($request->token) {
      if (Hash::check(env('APP_TOKEN'), $request->token)) {
        return $next($request);
      }
    }
    // return $app_token;
    return response()->json([
      'status' => 'error',
      'message' => 'You are not allowed to access this.',
    ], 401);
  }
}
