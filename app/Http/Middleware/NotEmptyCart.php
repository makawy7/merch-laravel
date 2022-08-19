<?php

namespace App\Http\Middleware;

use Closure;

class NotEmptyCart
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
        if(auth()->user() && count(auth()->user()->carts)==0){
          session()->flash('error','Your Shopping Cart Is Empty');
          return redirect()->route('index');
        }
        return $next($request);
    }
}
