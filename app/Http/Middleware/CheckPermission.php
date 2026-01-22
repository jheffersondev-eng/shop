<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Valida se o usuário autenticado tem permissão para acessar a ação solicitada
     *
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se o usuário não está autenticado, deixa passar (outra middleware trata auth)
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Se é admin (profile_id = null), permite acesso total
        if ($user->profile_id === null) {
            return $next($request);
        }

        // Obtém a rota atual
        $route = $request->route();
        
        if ($route === null) {
            return $next($request);
        }

        // Extrai o controller e o método da rota
        $controller = $route->getController();
        
        if ($controller === null) {
            return $next($request);
        }

        // Constrói a permissão no formato "ControllerName@method"
        $controllerName = class_basename($controller);
        $method = $route->getActionMethod();

        $method = $method == 'create' ? 'store' : $method;
        $method = $method == 'edit' ? 'update' : $method;
        
        $requiredPermission = strtolower("{$controllerName}@{$method}");

        // Verifica se o usuário tem permissão
        if (!$user->can($requiredPermission)) {
            abort(403, "Acesso negado. Você não tem permissão para: {$requiredPermission}");
        }

        return $next($request);
    }
}


