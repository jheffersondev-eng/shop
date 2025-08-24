<?php

namespace App\Traits;

trait TBaseEnum
{
    public function getValue(): int|string
    {
        return $this->value;
    }

    public function getDescription(): string
    {
        return ucfirst(strtolower($this->name));
    }

    public static function descriptions(): array
    {
        $result = [];
        foreach (self::cases() as $case) {
            $result[$case->value] = $case->getDescription();
        }
        return $result;
    }

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
