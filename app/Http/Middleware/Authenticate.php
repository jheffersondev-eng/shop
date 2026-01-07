<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Redireciona usuários não autenticados para o login
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se o usuário não está autenticado, redireciona para login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
