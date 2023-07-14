<?php

namespace App\Http\Middleware;

use Closure;

/**
 * ChangePasswordMiddleware
 * Handles employee change password when forgot
 *
 * @author Zin Lin Htet
 * @created 11/07/2023
 */
class ChangePasswordMiddleware
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
     * @created 11/07/2023
     */
    public function handle($request, Closure $next)
    {
        // Check if the session contains the 'verify-empid' key
        if (!session()->has('verify-empid')) {
            // If the 'verify-empid' key is not present, redirect to a different route
            return redirect()->route('login');
        }

        return $next($request);
    }
}
