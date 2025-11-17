<?php

namespace App\Repositories\Unit;

interface IUnitRepository
{
    public function getUnits();
    public function getUnitById($id);
    public function store($request);
    public function updateUnit($id, array $data);
}
