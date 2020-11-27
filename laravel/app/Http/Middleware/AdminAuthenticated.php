<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 22/04/2018
 * Time: 13:31
 */

namespace App\Http\Middleware;

use Closure;
class AdminAuthenticated
{
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        return redirect('/');
    }
}