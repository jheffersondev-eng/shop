<?php

namespace App\Interfaces;

interface IBaseEnum
{
    public function getValue(): int|string;
    public function getDescription(): string;

    public static function descriptions(): array;
    public static function values(): array;
}
