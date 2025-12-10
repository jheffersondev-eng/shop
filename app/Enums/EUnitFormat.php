<?php

namespace App\Enums;

use App\Interfaces\IBaseEnum;
use App\Traits\TBaseEnum;

enum EUnitFormat: int implements IBaseEnum
{
    use TBaseEnum;

    case DECIMAL = 1;
    case INTEGER = 2;
}
