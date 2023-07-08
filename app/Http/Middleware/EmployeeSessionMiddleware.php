<?php

namespace App\Http\Middleware;

use Closure;

/**
 * EmployeeSessionMiddleware
 * Handles employee login authentication
 *
 * @author Zin Lin Htet
 * @created 21/6/2023
 */
class EmployeeSessionMiddleware
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
     * @created 21/6/2023
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('employee')) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
