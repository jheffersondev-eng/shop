<?php

namespace App\Enums;

use App\Interfaces\IBaseEnum;
use App\Traits\TBaseEnum;

enum EIsActive: int implements IBaseEnum
{
    use TBaseEnum;

    case ACTIVE = 1;
    case INACTIVE = 0;

    public function getClasseBadge(): string
    {
        return match ($this) {
            self::ACTIVE => 'badge bg-success',
            self::INACTIVE => 'badge bg-danger',
        };
    }
}
