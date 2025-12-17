<?php

namespace App\Services\UnitService;

use App\Http\Dto\Unit\UnitDto;
use App\Models\Unit;
use App\Services\ServiceResult;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUnitService
{
    public function getUnits(): LengthAwarePaginator;
    public function getUnitById(int $id): Unit;
    public function create(UnitDto $unitDto): ServiceResult;
    public function update(UnitDto $unitDto, int $id): ServiceResult;
    public function delete(int $id): ServiceResult;
}