<?php

namespace App\Modules\Config;

use App\Helpers\ClassHelper;
use App\Models\Profile;
use App\Modules\Config\Headers\ConfigurationHeader;
use App\Modules\Config\Headers\DashboardHeader;
use App\Modules\Config\Headers\ProfileHeader;
use App\Modules\Config\Headers\UserHeader;
use App\Modules\Dashboard\DashboardModule;
use App\Modules\User\UserModule;
use App\Modules\Profile\ProfileModule;
use Illuminate\Support\Collection;
use Exception;
use RuntimeException;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class Configuration
{
    public static function getModules(): array
    {
        return [
            new DashboardModule(),
            new UserModule(),
            new ProfileModule(),
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
        $menu = new Collection();
        $menu->add(new DashboardHeader());
        $menu->add(new UserHeader());
        $menu->add(new ProfileHeader());
        $menu->add(new ConfigurationHeader());
        
        return $menu;
    }
}
