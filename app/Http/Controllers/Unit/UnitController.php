<?php

namespace App\Http\Controllers\Unit;

use App\Enums\EUnitFormat;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Repositories\Unit\IUnitRepository;

class UnitController extends BaseController
{
    public function __construct(IUnitRepository $unitRepository)
    {
        parent::__construct($unitRepository);

        $this->setPages(10);
        $this->setName('Unidade');
        $this->setUrl(url('unit'));
        $this->setFolderView('unit');
        $this->setOrderList(['id', 'asc']);
        $this->setModels('units');
    }

    public function Index(Request $request)
    {
        return parent::IndexBase($request);
    }

    public function Create()
    {
        return parent::CreateBase()
            ->with('unitFormats', EUnitFormat::toArray());
    }

    public function Store(Request $request)
    {
        return parent::StoreBase($request);
    }

    public function Edit($id)
    {
        $unit = $this->repository->findWithoutTrashed($id);
        return parent::EditBase($unit)
            ->with('unit', $unit)
            ->with('unitFormats', EUnitFormat::toArray());
    }

    public function Update(Request $request, int $id)
    {
        $data = $request->all();
        $this->repository->updateUnit($id, $data);
        return redirect()->route('unit.index')->with('success', 'Unidade atualizada com sucesso.');
    }

    public function Destroy(Request $request, int $id)
    {
        $unit = $this->repository->find($id);
        return parent::DestroyBase($unit, $request);
    }
}
