<?php

namespace App\Modules\Config;

class PermissionBlockResource extends PermissionBlock
{
    public function __construct(string $name, string $controller)
    {
        parent::__construct($name, $controller);
        $this->addAction("Consultar", "index");
        $this->addAction("Visualizar", "show");
        $this->addAction("Cadastrar", "store");
        $this->addAction("Editar", "edit");
        $this->addAction("Atualizar", "update");
        $this->addAction("Remover", "destroy");
    }
}
