<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;

class CompanyHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Loja";
    }

    public function getIcon(): string
    {
        return "bi bi-shop";
    }

    public function getLink(): string
    {
        return route('company.index');
    }

    public function hasSubMenu(): bool
    {
        return false;
    }

    public function getPermission(): string
    {
        return "companycontroller@index";
    }
}
