<?php

namespace App\Modules\Config;

use App\Helpers\ClassHelper;
use App\Modules\Login\LoginModule;
use Illuminate\Support\Collection;
use Exception;
use RuntimeException;

class Configuration
{
    public static function getModules(): array
    {
        return [
            new LoginModule()
        ];
    }

    /**
     * @param String $name
     * @return Module
     * @throws Exception
     */
    public static function getModuleByName(string $name): Module
    {
        foreach (self::getModules() as $module) {
            if (strtolower($name) == strtolower(ClassHelper::getBaseFromObject($module))) {
                return $module;
            }
        }
        throw new RuntimeException("Impossível identificar o relatorio");
    }

    /**
     * @return Collection
     */
    public static function getMenu(): Collection
    {
        return new Collection();
    }
}
