<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

/**
 * Helper para gerenciar permissões do usuário
 */
class PermissionHelper
{
    /**
     * Verifica se o usuário autenticado tem permissão para acessar uma ação
     * 
     * @param string $permission No formato "ControllerName@method"
     * @return bool
     */
    public static function canAccess(string $permission): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->can($permission);
    }

    /**
     * Verifica se o usuário autenticado é um administrador
     * 
     * @return bool
     */
    public static function isAdmin(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->profile_id === null;
    }

    /**
     * Obtém as permissões do usuário autenticado
     * 
     * @return array
     */
    public static function getUserPermissions(): array
    {
        if (!Auth::check()) {
            return [];
        }

        $user = Auth::user();
        // Se é admin, retorna um array vazio (tem acesso total)
        if ($user->profile_id === null) {
            return [];
        }

        // Se o usuário não tem profile, retorna array vazio
        if (!$user->profile || empty($user->profile->permission)) {
            return [];
        }

        // Quebra a string de permissões e remove espaços em branco
        return array_map('trim', explode(',', $user->profile->permission));
    }

    /**
     * Adiciona uma permissão à string de permissões do usuário (para uso em views)
     * 
     * @param string $permission No formato "ControllerName@method"
     * @return bool
     */
    public static function hasPermission(string $permission): bool
    {
        return self::canAccess($permission);
    }
}
