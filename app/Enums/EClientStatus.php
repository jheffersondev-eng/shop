<?php

namespace App\Enums;

use App\Interfaces\IBaseEnum;
use App\Traits\TBaseEnum;

enum EClientStatus: int implements IBaseEnum
{
    use TBaseEnum;

    case INACTIVE = 0;
    case ACTIVE = 1;
    case BLOCKED = 2;
}
