<?php

namespace App\Modules\Config;

class ActionModule
{
    private string $module;

    private array $screen;

    /**
     * ActionModule constructor.
     * @param string $module
     * @param array $screen
     */
    public function __construct(string $module, array $screen)
    {
        $this->module = $module;
        $this->screen = $screen;
    }

    /**
     * @return String
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @return array
     */
    public function getScreen(): array
    {
        return $this->screen;
    }
}
