<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CheckAimeosAdmin
{
    /**
     * Vérifie si l'utilisateur est administrateur Aimeos.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Gate::allows('admin')) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès refusé.');
    }
}
