<?php

namespace App\Http\Middleware;

use Closure;

class Seller
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
        if(function_exists('cansell')){
          if(cansell()){
            return $next($request);
          }else {
            if(auth()->user()){
              session()->flash('error','Your Subscription is Expired Or Under Review');
            }else {
              session()->flash('error','You\'re No authorized To View This Page');
            }
            return redirect()->route('index');
          }
        }else {
          return $next($request);
        }
    }
}
