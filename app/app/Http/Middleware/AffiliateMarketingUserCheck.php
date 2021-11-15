<?php

namespace App\Http\Middleware;

use Closure;

class AffiliateMarketingUserCheck
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
        if(!session('sessionAffiliateMarketingUserData')){
            return redirect()->route('affiliate_marketing_login')->with('message', "Login first.");
        }

        return $next($request);
    }
}
