<?php

namespace App\Repositories\Unit;

use App\Http\Dto\Unit\FilterDto;
use App\Http\Dto\Unit\UnitDto;
use App\Models\Unit;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUnitRepository
{
    public function getUnits(): LengthAwarePaginator;
    public function getUnitsByFilter(FilterDto $filterDto): LengthAwarePaginator;
    public function getUnitById(int $id): Unit;
    public function create(UnitDto $unitDto);
    public function update(UnitDto $unitDto, int $id);
    public function delete(int $id);
}
