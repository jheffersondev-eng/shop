<?php

namespace App\Modules\Config\Links\Configuration;

use App\Modules\Config\LinkMenu;

class LogoutLink extends LinkMenu
{
    public function getName(): String
    {
        return "Logout";
    }

    public function getIcon(): String
    {
        return "bi bi-box-arrow-right";
    }

    public function getPermission(): String
    {
        return "";
    }

    public function getLink(): String
    {
        return route('logout');
    }
}
