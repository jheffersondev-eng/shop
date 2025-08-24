<?php

namespace App\Modules\Config;

//use App\Business\User\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ItemMenu
{
    public function getName(): String;
    public function getIcon(): String;
    public function hasSubMenu(): Bool;

    public function getSubMenu(): Collection;
    public function getPermission(): String;
    public function getLink(): String;
    //public function userHasPermission(User $user): bool;
}
