<?php

namespace App\Modules\Config;

use Illuminate\Support\Collection;

/**
 * Simple link menu item (leaf node, no submenus).
 */
abstract class LinkMenu implements ItemMenu
{
    public function hasSubMenu(): bool
    {
        return false;
    }

    public function getSubMenu(): Collection
    {
        return new Collection();
    }

    public function getPermission(): ?string
    {
        return null;
    }

    public function getLink(): ?string
    {
        return null;
    }
}
