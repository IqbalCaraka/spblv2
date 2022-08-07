<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        if(Auth::user() && (Auth::user()->peran_id=='1' || Auth::user()->peran_id == '2')){
            return $next($request);
        }

        return redirect('menu')->with('error', 'Kamu tidak memilki akses Admin!');
    }
}
