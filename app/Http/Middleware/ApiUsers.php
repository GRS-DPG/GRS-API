<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiUser;
use Illuminate\Support\Facades\Hash;

class ApiUsers
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
        if ($request->user_name && $request->password){
            $user_info = ApiUser::where('username',$request->user_name)->where('active_status',1)->first();
            if($user_info){
                if (Hash::check($request->password, $user_info->password)) {
                    return $next($request);
                }
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'You are not allowed to access this.',
        ], 401);
    }
}
