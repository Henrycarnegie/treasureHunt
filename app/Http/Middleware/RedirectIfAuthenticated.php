<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->hasRole('guru')) {
                return redirect('/guru');
            } elseif ($user->hasRole('polisi') || $user->hasRole('detektif') || $user->hasRole('nelayan') || $user->hasRole('petani')) {
                return redirect('/murid/home');
            }
        }

        return $next($request);
    }
}
