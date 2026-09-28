<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //dd($guard);
            switch ($guard) {
                case 'mnre':
                    
                    return redirect()->intended(route('mnre.dashboard'));
                    break;
                case 'manufacturer_users':
                    //return redirect('/users');
                    return redirect()->intended(route('users.dashboard'));
                    break;
                case 'nise':
                    return redirect()->intended(route('nise.dashboard'));
                    break;
                default:
                    return redirect()->intended(RouteServiceProvider::HOME);
                    break;
            }
        }

        return $next($request);
    }
}