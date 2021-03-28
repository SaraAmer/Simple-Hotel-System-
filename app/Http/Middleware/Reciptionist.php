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
        if (Auth::user()->role=="Receptionist"||Auth::user()->role=="Admin"||Auth::user()->role=="Manager") {
            return $next($request);
        } else {
            return redirect('/notfound');
            // return view('404');
        }
    }
}
