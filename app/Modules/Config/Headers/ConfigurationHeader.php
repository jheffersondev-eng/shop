<?php

namespace App\Modules\Config\Headers;

use App\Modules\Config\HeaderMenu;
use App\Modules\Config\Links\Configuration\LogoutLink;
use App\Modules\Config\Links\Configuration\UserProfileLink;
use Illuminate\Support\Collection;

class ConfigurationHeader extends HeaderMenu
{
    public function getName(): string
    {
        return "Configurações";
    }

    public function getIcon(): string
    {
        return "bi bi-gear";
    }

    public function getLink(): string
    {
        return route('user.index');
    }

    public function hasSubMenu(): bool
    {
        return true;
    }

    public function getSubMenu(): Collection
    {
        $collection = new Collection();
        $collection->add(new UserProfileLink());
        $collection->add(new LogoutLink());

        return $collection;
    }
}