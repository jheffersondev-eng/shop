<?php

namespace App\Modules\Config;

use App\Helpers\ClassHelper;
use App\Modules\Config\Headers\ConfigurationHeader;
use App\Modules\Config\Headers\DashboardHeader;
use App\Modules\Config\Headers\ProductHeader;
use App\Modules\Config\Headers\ProfileHeader;
use App\Modules\Config\Headers\UserHeader;
use App\Modules\Config\Headers\CategoryHeader;
use App\Modules\Config\Headers\UnitHeader;
use App\Modules\Dashboard\DashboardModule;
use App\Modules\Product\ProductModule;
use App\Modules\User\UserModule;
use App\Modules\Profile\ProfileModule;
use App\Modules\Category\CategoryModule;
use App\Modules\Profile\UserProfileModule;
use App\Modules\Unit\UnitModule;
use Illuminate\Support\Collection;
use RuntimeException;

class Configuration
{
    public static function getModules(): array
    {
        return [
            new DashboardModule(),
            new ProductModule(),
            new UserModule(),
            new ProfileModule(),
            new CategoryModule(),
            new UnitModule(),
            new UserProfileModule(),
        ];
    }

    public static function getModuleByName(string $name): Module
    {
        foreach (self::getModules() as $module) {
            if (strtolower($name) == strtolower(ClassHelper::getBaseFromObject($module))) {
                return $module;
            }
        }
        throw new RuntimeException("Impossível identificar o relatorio");
    }

    public static function getMenu(): Collection
    {
        $menu = new Collection();
        $menu->add(new DashboardHeader());
        $menu->add(new ProductHeader());
        $menu->add(new UserHeader());
        $menu->add(new ProfileHeader());
        $menu->add(new CategoryHeader());
        $menu->add(new UnitHeader());
        $menu->add(new ConfigurationHeader());
        
        return $menu;
    }

    public static function getPermissionNames(array $actions): array
    {
        $permissionNames = [];
        $modules = self::getModules();

        foreach ($actions as $actionString) {
            foreach ($modules as $module) {
                if (!method_exists($module, 'getActionsWeb')) {
                    continue;
                }

                $actionModule = $module->getActionsWeb();
                if (!is_object($actionModule) || !method_exists($actionModule, 'getActionsWeb')) {
                    continue;
                }

                $actionsWeb = $actionModule->getActionsWeb();
                if (!is_array($actionsWeb) || !isset($actionsWeb['actions'], $actionsWeb['name'])) {
                    continue;
                }

                $moduleName = $actionsWeb['name'];
                $moduleActions = $actionsWeb['actions'];

                // Procurar a ação neste módulo
                foreach ($moduleActions as $action) {
                    if (isset($action['action']) && isset($action['name'])) {
                        // Comparação case-insensitive
                        if (strtolower($action['action']) === strtolower($actionString)) {
                            // Retornar "Nome da Action Nome do Module"
                            $permissionNames[] = $action['name'] . ' ' . $moduleName;
                            break 2; // Sair dos dois foreach quando encontrado
                        }
                    }
                }
            }
        }

        return $permissionNames;
    }
}
