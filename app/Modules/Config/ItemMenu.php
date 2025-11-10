<?php

namespace App\Modules\Config;

use Illuminate\Support\Collection;

interface ItemMenu
{
    public function getName(): string;
    public function getIcon(): string;
    public function hasSubMenu(): bool;

    public function getSubMenu(): Collection;
    public function getPermission(): ?string;
    public function getLink(): ?string;
}
