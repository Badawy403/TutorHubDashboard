<?php

namespace App\Http\Middleware;

use App\Models\Role;
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
                $user = request()->user();
                if ($user->hasRole(Role::$SuperAdmin) && $request->session()->get('logged_in_as') == 'super_admin') {
                    return redirect(route('super_admin.dashboard'));
                } else if ($user->hasRole(Role::$Admin) && $request->session()->get('logged_in_as') == 'admin') {
                    return redirect(route('super_admin.dashboard'));
                } else if ($user->hasRole(Role::$Teacher) && $request->session()->get('logged_in_as') == 'teacher') {
                    return redirect(route('home'));
                } else if ($user->hasRole(Role::$Academy) && $request->session()->get('logged_in_as') == 'academy') {
                    return redirect(route('home'));
                } else {
                    return redirect(route('home'));
                }
            }
        }
        return $next($request);
    }
}
