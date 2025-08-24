<?php

namespace App\Enums;

use App\Interfaces\IBaseEnum;
use App\Traits\TBaseEnum;

enum EIsActive: int implements IBaseEnum
{
    use TBaseEnum;

    case NO = 0;
    case YES = 1;

    public function getClasseBadge(): string
    {
        return match ($this) {
            self::NO => 'success',
            self::YES => 'danger',
        };
    }
}
