<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Repositories\Unit\IUnitRepository;
use App\Models\Unit;

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
    }

    public function Index(Request $request)
    {
        return parent::IndexBase($request)->with('units', $this->repository->getUnits());
    }

    public function Create()
    {
        return parent::CreateBase();
    }

    public function Store(Request $request)
    {
        return parent::StoreBase($request);
    }

    public function Edit($id)
    {
        $unit = $this->repository->getUnitById($id);
        return parent::EditBase($unit)->with('unit', $unit)->with('model', $unit);
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
