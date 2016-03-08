<?php

namespace App\Http\Middleware;

use Closure;
use Flash;
class RedirectIfNotAdmin
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

            if (!$request->user()->isAdmin()) {
                Flash::warning('You do not have that permission!');
                return redirect('/');
            }

        return $next($request);
    }
}
