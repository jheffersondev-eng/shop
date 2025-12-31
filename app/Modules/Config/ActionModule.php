<?php

namespace App\Modules\Config;

class ActionModule
{
    private string $name;
    private array $actions;

    /**
     * ActionModule constructor.
     * @param string $name
     * @param array $actions
     */
    public function __construct(string $name, array $actions)
    {
        $this->name = $name;
        $this->actions = $actions;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @return array
     */
    public function getActionsWeb(): array
    {
        return [
            'name' => $this->name,
            'actions' => $this->actions
        ];
    }
}
