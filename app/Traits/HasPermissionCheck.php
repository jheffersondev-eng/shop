<?php

namespace App\Traits;

trait HasPermissionCheck
{
    /**
     * Verifica se o usuário tem permissão para acessar uma ação específica
     * 
     * @param string $permission No formato "ControllerName@method"
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        // Se o usuário não tem profile_id, é um admin com permissão total
        if ($this->profile_id === null) {
            return true;
        }

        // Se o usuário não tem profile, nega acesso
        if (!$this->profile) {
            return false;
        }

        // Se o profile não tem permissões definidas, nega acesso
        if (empty($this->profile->permission)) {
            return false;
        }

        // Quebra a string de permissões e remove espaços em branco
        $permissions = array_map('trim', explode(',', $this->profile->permission));

        // Verifica se a permissão solicitada está na lista
        return in_array($permission, $permissions);
    }
}

