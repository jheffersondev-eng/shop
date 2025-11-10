<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;

class DashboardHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Dashboard";
    }

    public function getIcon(): string
    {
        return "bi bi-grid";
    }

    public function getLink(): string
    {
        return route('dashboard');
    }

    public function hasSubMenu(): bool
    {
        return false;
    }
}