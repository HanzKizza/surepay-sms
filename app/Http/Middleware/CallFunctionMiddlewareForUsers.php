<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallFunctionMiddlewareForUsers
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
        if(session('user') !== null){
            $user = DB::select("select * from user  left join vendor on(user.vendorId = vendor.vendorId) where user.userId", [session('user')[0]->userId]);
            session(['user'=> $user]);
        }
        return $next($request);
    }
}
