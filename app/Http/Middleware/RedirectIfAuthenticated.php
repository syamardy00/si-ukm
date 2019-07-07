<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        if(Auth::guard('adminUkm')->check()){
          return redirect('/profil-ukm');
        }else if(Auth::guard('anggotaUkm')->check()){
          return redirect(route('anggotaUkm.ukm.index'));
        }else if(Auth::guard('admin')->check()){
          return redirect(route('admin'));
        }else if(Auth::guard('monitoring')->check()){
          return redirect('/monitoring');
        }

        return $next($request);
    }
}
