<?php

namespace App\Modules\Config\Links\Configuration;

use App\Modules\Config\LinkMenu;

class PerfilLink extends LinkMenu
{
    public function getName(): String
    {
        return "Meu Perfil";
    }

    public function getIcon(): String
    {
        return "bi bi-person-circle";
    }

    public function getPermission(): String
    {
        return "";
    }

    public function getLink(): String
    {
        return route('profile.index');
    }
}
