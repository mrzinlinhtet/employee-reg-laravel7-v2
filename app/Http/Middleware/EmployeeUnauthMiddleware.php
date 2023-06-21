<?php

namespace App\Http\Middleware;

use Closure;

class EmployeeUnauthMiddleware
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
        if (session()->has('employee')) {
            return redirect()->route('employees.index');
        }

        return $next($request);
    }
}
