<?php

namespace App\Http\Middleware;

use Closure;

class IsPendingOrder
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
        if (!$request->route('order')->isPending()) {
            return redirect()->route('cart');
        }

        return $next($request);
    }
}
