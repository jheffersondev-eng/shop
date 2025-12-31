<?php

namespace App\Modules\Config\Links\Configuration;

use App\Modules\Config\LinkMenu;
use Illuminate\Support\Facades\Auth;

class UserProfileLink extends LinkMenu
{
    public function getName(): String
    {
        return "Meu Perfil";
    }

    public function getIcon(): String
    {
        return "bi bi-person-circle";
    }

    public function getPermission(): String
    {
        return "UserProfileController@Edit";
    }

    public function getLink(): String
    {
        return route('userProfile.edit', Auth::user()->id);
    }
}
