<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->is_active === 0) {
            Auth::logout();
            return redirect()->route('prepage')->withErrors([
                'failed' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.',
            ]);
        }
        return $next($request);
    }
}
