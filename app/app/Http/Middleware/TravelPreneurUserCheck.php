<?php

namespace App\Http\Middleware;

use Closure;

class TravelPreneurUserCheck
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
        if(!session('user_data')){
            return redirect()->route('travel_preneur_welcome')->with('message', "Login first.");
        }
        return $next($request);
    }
}
