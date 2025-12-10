<?php

namespace App\Interfaces;

interface IBaseEnum
{
    public function getValue(): int|string;
    public function getDescription(): string;

    public static function toArray(): array;
    public static function values(): array;
}
