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
        return EnumTranslator::translate(static::class, $this->name);
    }

    public static function toArray(): array
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

    /**
     * Retorna opções no formato aceito pelo SelectHelper/Blade:
     * cada item deve permitir $item->id e $item['name'].
     */
    public static function toArrayOptions(): array
    {
        // Usa Illuminate\Support\Fluent para suportar acesso por propriedade e ArrayAccess
        $items = [];
        foreach (self::cases() as $case) {
            $items[] = new \Illuminate\Support\Fluent([
                'id' => $case->value,
                'name' => $case->getDescription(),
            ]);
        }
        return $items;
    }
}
