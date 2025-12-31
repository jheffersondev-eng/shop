<?php

namespace App\Traits;

use App\Enums\EUnitFormat;
use App\Enums\EIsActive;

class EnumTranslator
{
    /**
     * Mapa de traduções para os enums
     * Formato: EnumClass::class => ['CASE_NAME' => 'Tradução']
     */
    private static array $translations = [
        EUnitFormat::class => [
            'DECIMAL' => 'Decimal',
            'INTEGER' => 'Inteiro',
        ],
        EIsActive::class => [
            'ACTIVE' => 'Ativo',
            'INACTIVE' => 'Inativo',
        ],
    ];

    /**
     * Obtém a tradução de um case do enum
     */
    public static function translate(string $enumClass, string $caseName, ?string $default = null): string
    {
        if (isset(self::$translations[$enumClass][$caseName])) {
            return self::$translations[$enumClass][$caseName];
        }

        return $default ?? ucfirst(strtolower($caseName));
    }

    /**
     * Adiciona uma tradução
     */
    public static function add(string $enumClass, string $caseName, string $translation): void
    {
        if (!isset(self::$translations[$enumClass])) {
            self::$translations[$enumClass] = [];
        }

        self::$translations[$enumClass][$caseName] = $translation;
    }

    /**
     * Obtém todas as traduções de um enum
     */
    public static function all(string $enumClass): array
    {
        return self::$translations[$enumClass] ?? [];
    }
}
