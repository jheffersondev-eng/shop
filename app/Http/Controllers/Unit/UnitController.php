<?php

namespace App\Http\Controllers\Unit;

use App\Enums\EUnitFormat;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Unit\UnitRequest;
use Illuminate\Http\Request;
use App\Services\UnitService\IUnitService;

class UnitController extends BaseController
{
    protected IUnitService $unitService;

    public function __construct(IUnitService $unitService) 
    {
        $this->unitService = $unitService;
    }

    public function Index(Request $request)
    {
        $units = $this->unitService->getUnits();

        return view('unit.index', [
            'url' => route('unit.index'),
            'title' => 'Unidades',
            'units' => $units,
        ]);
    }

    public function Create()
    {
        $unitFormats = EUnitFormat::toArray();

        return view('unit.create', [
            'url' => route('unit.index'),
            'unitFormats' => $unitFormats,
        ]);
    }

    public function Edit(int $id)
    {
        $unit = $this->unitService->getUnitById($id);
        $unitFormats = EUnitFormat::toArray();

        return view('unit.edit')->with([
            'url' => route('unit.index'),
            'unit' => $unit,
            'unitFormats' => $unitFormats,
        ]);
    }

    public function Store(UnitRequest $request)
    {
        $dto = $request->getDto();

        return $this->execute(
            callback: fn() => $this->unitService->create($dto),
            defaultSuccessMessage: 'Unidade criada com sucesso',
            successRedirect: route('unit.index'),
        );
    }

    public function Update(UnitRequest $request, int $id)
    {
        $dto = $request->getDto();

        return $this->execute(
            callback: fn() => $this->unitService->update($dto, $id),
            defaultSuccessMessage: 'Unidade atualizada com sucesso',
            successRedirect: route('unit.index'),
        );
    }

    public function Destroy(int $id)
    {
        return $this->execute(
            callback: fn() => $this->unitService->delete($id),
            defaultSuccessMessage: 'Unidade removida com sucesso',
            successRedirect: route('unit.index'),
        );
    }
}
