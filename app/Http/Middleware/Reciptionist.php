<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Reciptionist
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
        if (Auth::user()->role=="Receptionist" || Auth::user()->role=="Manager"||Auth::user()->role=="Admin") {
            if (!Auth::user()->hasRole('receptionist') && Auth::user()->role=="receptionist") {
                Auth::user()->assignRole('receptionist');
            }
            return $next($request);
        } else {
            abort('403', 'Access denied');
        }
    }
}
