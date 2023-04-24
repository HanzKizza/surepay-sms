<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallFunctionMiddlewareForVendors
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
        if(session('vendor')){
            $vendor = DB::select("select * from vendor where vendorId = ?", [session('vendor')[0]->vendorId]);
            session(['vendor'=> $vendor]);
        }
        return $next($request);
    }
}
