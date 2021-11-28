<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (!auth()->check()) {
            return redirect('/no-authorize');
        }

        if (auth()->user()->role == 'admin') {
            return $next($request);
        }
        if(auth()->user()->role == 'user'){
            return redirect('/no-authorize');
        }
        return redirect('/');

    }
}
