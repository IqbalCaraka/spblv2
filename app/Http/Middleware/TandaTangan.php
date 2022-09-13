<?php

namespace App\Http\Middleware;

use App\DokumenPenyerahan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use Closure;

class TandaTangan
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
        $url = $request->path();
        $id = explode('/', $url);
        $id = end($id);
        if(Auth::user()->id == $id ){
            return $next($request);
        }
        return redirect('denied')->with('error', 'Kamu tidak memiliki akses Admin!');
    }
}
