<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        $user = auth()->user();

        if (!in_array($user->role, $roles)) {
            abort(403);
        }

        /*
         * Un médecin doit être validé par l'administration
         * avant d'accéder aux fonctionnalités médicales.
         */
        if (
            $user->role === 'medecin' &&
            $user->statut !== 'active'
        ) {
            return response()
                ->view('auth.medecin-pending', compact('user'), 403);
        }

        return $next($request);
    }
}