<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;

class UserHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Usuários";
    }

    public function getIcon(): string
    {
        return "bi bi-people";
    }

    public function getLink(): string
    {
        return route('user.index');
    }

    public function hasSubMenu(): bool
    {
        return false;
    }
}