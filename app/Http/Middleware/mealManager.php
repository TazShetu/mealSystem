<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class mealManager
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
        $u = Auth::user();
        if ($u->hasRole('mealManager')){
            return $next($request);
        } else {
            abort(403);
        }
    }
}
