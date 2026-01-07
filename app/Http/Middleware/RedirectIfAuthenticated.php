<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Redireciona usuários autenticados para o dashboard se tentarem acessar login
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se o usuário está autenticado, redireciona para dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
