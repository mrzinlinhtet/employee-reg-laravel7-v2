<?php

namespace App\Http\Middleware;

use Closure;

/**
 * EmployeeAuthMiddleware
 * Handles employee login authentication
 *
 * @author Zin Lin Htet
 * @created 21/06/2023
 */
class EmployeeAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /**
     * @author Zin Lin Htet
     * @created 21/06/2023
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('employee')) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
