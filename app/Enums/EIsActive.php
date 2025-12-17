<?php

namespace App\Enums;

use App\Interfaces\IBaseEnum;
use App\Traits\TBaseEnum;

enum EIsActive: int implements IBaseEnum
{
    use TBaseEnum;

    case ACTIVE = 0;
    case INACTIVE = 1;

    public function getClasseBadge(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
        };
    }
}
