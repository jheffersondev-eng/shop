<?php

namespace App\Modules\Config;

use App\Modules\Config\ReportAbstract;
use App\Helpers\ClassHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Exception;
use RuntimeException;

abstract class Module
{
    abstract public function getName(): String;
    abstract public function getIcon(): String;

    /**
     * Vai ser chamado no boot do app service provider
     * Aqui você pode configurar por exemplo os observers dos modules
     */
    public function boot()
    {
    }

    /**
     * Vai ser chamado no register do app service provider
     * Aqui você pode configurar por exemplo as injeções de dependências
     * desse módulo
     */
    public function register(Application $app)
    {
    }

    /**
     * @return RouteModule|null
     */
    public function getRoutesWeb()
    {
        return null;
    }

    /**
     * @return RouteModule|null
     */
    public function getRoutesApi()
    {
        return null;
    }

    /**
     * @return RouteModule|null
     */
    public function getRoutesErp(): ?RouteModule
    {
        return null;
    }

    /**
     * @return Collection|null
     */
    public function getReports()
    {
        return null;
    }

    /**
     * @return ActionModule|null
     */
    public function getActionsWeb()
    {
        return null;
    }

    /**
     * @param String $name
     * @return ReportAbstract
     * @throws Exception
     */
    public function getReportByName(string $name): ReportAbstract
    {
        $reports = $this->getReports();
        if ($reports == null) {
            throw new Exception("Impossível identificar o relatorio");
        }

        /**
         * @var ReportAbstract $report
         */
        foreach ($reports as $report) {
            if (strtolower($name) == strtolower(ClassHelper::getBaseFromObject($report))) {
                return $report;
            }
        }
        throw new RuntimeException("Impossível identificar o relatorio");
    }
}
