<?php

namespace App\Modules\Config;

class PermissionBlock
{
    private string $name;
    private array $actions = [];
    private string $controller;

    /**
     * PermissionBlock constructor.
     */
    public function __construct(string $name, string $controller)
    {
        $this->name = $name;
        $this->controller = $controller;
    }

    public function addAction(string $name, string $action): PermissionBlock
    {
        $controllerName = class_basename($this->controller);
        $this->actions[] = [
            "name" => $name,
            "action" => $controllerName . "@" . $action
        ];

        return $this;
    }

    public function removeAction(string $name): PermissionBlock
    {
        $chave = false;
        foreach ($this->actions as $key => $acao) {
            if ($acao['name'] == $name) {
                $chave = $key;
                break;
            }
        }

        if (!$chave) {
            return $this;
        }

        unset($this->actions[$key]);

        return $this;
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "actions" => $this->actions
        ];
    }
}
