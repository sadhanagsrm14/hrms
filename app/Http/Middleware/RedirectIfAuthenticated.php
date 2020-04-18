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
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->role == 1){
                return redirect('/admin/dashboard');
            }
            if(Auth::user()->role == 2){
                return redirect('/hrManager/dashboard');
            }
            if(Auth::user()->role == 3){
                return redirect('/hrExecutive/dashboard');
            }
            
            if(Auth::user()->role == 5){
                return redirect('/itExecutive/dashboard');
            }
            if(Auth::user()->role == 6 || Auth::user()->role == 4){
                return redirect('/employee/dashboard');
            }
        }

        return $next($request);
    }
}
