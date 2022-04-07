<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        if( !auth()->user() || auth()->user()->type != 'admin') {
        if((auth()->user() && auth()->user()->type !='admin') || !auth()->user()){
            if(auth()->user()) {
                auth()->logout();
            }

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        return $next($request);
    }
}
