<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;

class CategoryHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Categorias";
    }

    public function getIcon(): string
    {
        return "bi bi-tags";
    }

    public function getLink(): string
    {
        return route('category.index');
    }

    public function hasSubMenu(): bool
    {
        return false;
    }

    public function getPermission(): string
    {
        return "categorycontroller@index";
    }
}
