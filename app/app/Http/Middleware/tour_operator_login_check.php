<?php

namespace App\Http\Middleware;

use Closure;

class tour_operator_login_check
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
        if(!session('tour_operator_data')) {
            return redirect()->route('seller_login')->with('message','Please Login First');
        }

        return $next($request);
    }
}
