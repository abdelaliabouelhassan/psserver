<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class only_admin
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
       
        if(auth('sanctum')->check()  &&  auth('sanctum')->user()->is_admin){
             return $next($request);
        }else{
            return abort(404);
        }

       
    }
}
