<?php

namespace App\Repositories\Unit;

use App\Models\Unit;
use App\Repositories\BaseRepository;

class UnitRepository extends BaseRepository implements IUnitRepository
{
    public function __construct()
    {
        parent::__construct(new Unit());
    }

    public function getUnits()
    {
        return $this->model->withoutTrashed()->get();
    }

    public function getUnitById($id)
    {
        return $this->model->withoutTrashed()->find($id);
    }

    public function store($request)
    {
        $data = method_exists($request, 'validated') ? $request->validated() : $request->all();
        $this->model->getModel()->create($data);
    }

    public function updateUnit($id, array $data)
    {
        $unit = $this->getUnitById($id);
        if ($unit) {
            $unit->update($data);
            return $unit;
        }
        return null;
    }

    public function delete(Unit $unit)
    {
        return $unit->delete();
    }
}
