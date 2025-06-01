<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // User is authenticated - redirect based on user role
                if (Auth::user()->role_id == 1) {
                    return redirect()->route('dashboard'); // Admin dashboard
                } else if (Auth::user()->role_id == 2) {
                    return redirect()->route('userdashboard'); // User dashboard
                }
                return redirect('/'); // Default redirect to home
            }
        }

        // User is a guest (not authenticated) - allow them to continue to login/register
        return $next($request);
    }
}
