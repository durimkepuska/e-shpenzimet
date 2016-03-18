<?php

namespace App\Http\Middleware;

use Closure;
use Flash;
use Redirect;
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
                Flash::warning('Ky veprim nuk lejohet, kontaktoni personin përgjegjës!');
                 return Redirect::back();
            }
            return $next($request);
    }
}
