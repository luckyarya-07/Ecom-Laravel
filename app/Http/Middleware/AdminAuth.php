<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminAuth
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
       if(Auth::user()->email == 'admin2131@gmail.com') {
           
       }else {
        //    $request->session()->flash('error','Access Denied');
           return redirect('/');
       }
          
                   
       return $next($request);
    }
}
