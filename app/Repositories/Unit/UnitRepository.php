<?php

namespace App\Repositories\Unit;

use App\Http\Dto\Unit\UnitDto;
use App\Models\Unit;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class UnitRepository extends BaseRepository implements IUnitRepository
{
    const PAGINATION_SIZE = 10;

    public function __construct()
    {
        parent::__construct(new Unit());
    }

    public function getUnits(): LengthAwarePaginator
    {
        return $this->model->paginate(self::PAGINATION_SIZE);
    }

    public function getUnitById(int $id): Unit
    {
        $unit = $this->model->find($id);

        if (!$unit) {
            throw new Exception("Unidade não encontrada.");
        }
        
        return $unit;
    }

    public function create(UnitDto $unitDto)
    {
        $data = [
            'name' => $unitDto->name,
            'abbreviation' => $unitDto->abbreviation,
            'format' => $unitDto->format,
        ];
        
        return $this->model->create($data);
    }

    public function update(UnitDto $unitDto, int $id)
    {
        $unit = $this->model->find($id);

        if (!$unit) {
            throw new Exception("Unidade não encontrada.");
        }
        $data = [
            'name' => $unitDto->name,
            'abbreviation' => $unitDto->abbreviation,
            'format' => $unitDto->format,
        ];
        
        return $this->model->update($data);
    }

    public function delete(int $id)
    {
        $unit = $this->model->find($id);
        
        if (!$unit) {
            throw new Exception("Unidade não encontrada.");
        }

        return $unit->delete();
    }
}
