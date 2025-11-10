<?php

namespace App\Enums;

use App\Interfaces\IBaseEnum;
use App\Traits\TBaseEnum;

enum EProfile: int implements IBaseEnum
{
    use TBaseEnum;

    case ADMIN = 1;
    case SELLER = 2;
}
