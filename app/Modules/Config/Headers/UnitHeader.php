<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;

class UnitHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Unidades";
    }

    public function getIcon(): string
    {
        return "bi bi-rulers";
    }

    public function getLink(): string
    {
        return route('unit.index');
    }

    public function hasSubMenu(): bool
    {
        return false;
    }
}
