<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use  \Illuminate\Support\Facades\App;

class ChckLang
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


        if (session()->has('lang')) {
            App::setLocale(session()->get('lang'));
        } else {
            session(['lang' => 'en']);
            App::setLocale('en');
        }

        return $next($request);
    }
}
