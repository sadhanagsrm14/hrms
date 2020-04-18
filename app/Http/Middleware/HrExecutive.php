<?php

namespace App\Http\Middleware;

use Closure;

class HrExecutive
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
       if(\Auth::check()){
        if(\Auth::user()->role != 3){
            return  redirect('/login');
        }
    }else{
        return  redirect('/login');
    }
    return $next($request);
}
}
