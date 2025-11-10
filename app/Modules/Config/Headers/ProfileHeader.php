<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;

class ProfileHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Perfis";
    }

    public function getIcon(): string
    {
        return "bi bi-people";
    }

    public function getLink(): string
    {
        return route('profile.index');
    }

    public function hasSubMenu(): bool
    {
        return false;
    }
}