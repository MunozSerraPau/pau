<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->administrador) {
            return $next($request);
        }

        abort(403, 'Accés no autoritzat');
    }
}

