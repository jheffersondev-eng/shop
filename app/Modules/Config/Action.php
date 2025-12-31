<?php

namespace App\Modules\Config;

class Action
{
    /**
     * @var string
     */
    public string $action;

    /**
     * @var string
     */
    public string $name;

    /**
     * @param string $action
     * @param string $name
     */
    public function __construct(string $action, string $name)
    {
        $this->action = $action;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        $parts = explode('\\', $this->action);
        return end($parts);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param array $module
     * @return array
     */
    public static function getAllModuleAction(array $module): array
    {
        $actions = [];
        if (!isset($module['actions']) || !is_array($module['actions'])) {
            return $actions;
        }
        foreach ($module['actions'] as $action) {
            if (isset($action['action'], $action['name'])) {
                $actionObj = new self((string)$action['action'], (string)$action['name']);
                $actions[] = $actionObj->getActionName();
            }
        }
        return $actions;
    }

    /**
     * @param array $modules
     * @return array
     */
    public static function getPermissions(array $modules): array
    {
        $allSystemActions = [];
        foreach ($modules as $module) {
            if (!method_exists($module, 'getActionsWeb')) {
                continue;
            }
            $actionsWebObj = $module->getActionsWeb();
            if (!is_object($actionsWebObj) || !method_exists($actionsWebObj, 'getActionsWeb')) {
                continue;
            }
            $actionsWeb = $actionsWebObj->getActionsWeb();
            if (!is_array($actionsWeb) || !isset($actionsWeb['actions'])) {
                continue;
            }
            $allSystemActions = array_merge($allSystemActions, $actionsWeb['actions']);
        }
        return $allSystemActions;
    }

    /**
     * @return array
     */
    public static function webActions(): array
    {
        $modules = Configuration::getModules();
        return self::getPermissions($modules);
    }

    /**
     * @return array
     */
    public static function apiActions(): array
    {
        $modules = Configuration::getModules();
        return self::getPermissions($modules);
    }
}
