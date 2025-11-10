<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;

class ProductHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Produtos";
    }

    public function getIcon(): string
    {
        return "bi bi-box";
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
