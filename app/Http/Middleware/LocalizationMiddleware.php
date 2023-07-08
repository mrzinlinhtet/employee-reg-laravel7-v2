<?php

namespace App\Http\Middleware;

use Closure;

/**
 * LocalizationMiddleware
 * Handles language change
 *
 * @author Zin Lin Htet
 * @created 05/07/2023
 */
class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /**
     * To determine the preferred locale.
     * @author Zin Lin Htet
     * @created 05/07/2023
     */
    public function handle($request, Closure $next)
    {
        if (session('locale')) {
            app()->setLocale(session('locale'));
        } else {
            //default en
            session()->put('locale', 'en');
            app()->setLocale(session('locale'));
        }
        return $next($request);
    }
}
