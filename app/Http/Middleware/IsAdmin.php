<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(!auth()->user()){
          return redirect()->route('adminlogin');
        }
        if(auth()->user() && !auth()->user()->admin()){
          session()->flash('error','You\'re not authorized to view this page!');
          return redirect()->route('index');
        }
        return $next($request);
    }
}
