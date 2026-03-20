<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para acceder.');
        }

        $user = Auth::user();

        if ($user->rol !== $role) {
            // Si es administrador, ir al dashboard
            if ($user->rol === 'administrador') {
                return redirect()->route('dashboard')->with('error', 'No tiene acceso a esta sección.');
            }
            // Si es operador, ir al formulario de fallas
            return redirect()->route('fallas.index')->with('error', 'No tiene acceso a esta sección.');
        }

        return $next($request);
    }
}

