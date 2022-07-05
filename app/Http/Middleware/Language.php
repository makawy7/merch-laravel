<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Language
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
      ((session()->has('lang'))?$lang=session('lang'):$lang='ar');
      App::setLocale($lang);
      return $next($request);
    }
}
