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
        return "bi bi-box-seam";
    }

    public function getLink(): string
    {
        return route('product.index');
    }

    public function hasSubMenu(): bool
    {
        return false;
    }

    public function getPermission(): string
    {
        return "productcontroller@index";
    }
}
