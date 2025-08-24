<?php

namespace App\Modules\Config;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

abstract class ReportAbstract
{
    /**
     * @var array
     */
    protected array $basesRestritasIds = [];

    /**
     * Gera o PDF a partir de uma view.
     * @param string $view
     * @param array $data
     * @return \Barryvdh\DomPDF\PDF
     */
    protected function loadView(string $view, array $data = [])
    {
        $pdf = Pdf::loadView($view, $data);
        $pdf->setOptions(['defaultFont' => 'serif', 'isRemoteEnabled' => true]);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);
        return $pdf;
    }

    /**
     * Define as bases restritas.
     * @param array $basesRestritasIds
     * @return static
     */
    public function restritoParaBases(array $basesRestritasIds): static
    {
        $this->basesRestritasIds = $basesRestritasIds;
        return $this;
    }

    /**
     * Verifica se está ativo para a base.
     * @param int $baseId
     * @return bool
     */
    public function ativoParaABase(int $baseId): bool
    {
        return empty($this->basesRestritasIds) ? true : in_array($baseId, $this->basesRestritasIds);
    }

    abstract public function getNome(): string;
    abstract public function getCamposGeracao(): View;
    abstract public function gerar(Request $request);
    abstract public function getId(): string;
}
