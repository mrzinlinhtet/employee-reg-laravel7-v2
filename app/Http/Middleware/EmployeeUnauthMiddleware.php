<?php

namespace App\Http\Middleware;

use Closure;

/**
 * EmployeeUnauthMiddleware
 * Handles employee login authentication
 *
 * @author Zin Lin Htet
 * @created 21/06/2023
 */
class EmployeeUnauthMiddleware
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
            return redirect()->route('employees.index');
        }

        return $next($request);
    }
}
