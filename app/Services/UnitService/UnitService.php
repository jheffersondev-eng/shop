<?php

namespace App\Services\UnitService;

use App\Http\Dto\Unit\FilterDto;
use App\Http\Dto\Unit\UnitDto;
use App\Mapper\UnitAggregateMapper;
use App\Models\Unit;
use App\Repositories\Unit\IUnitRepository;
use App\Services\ServiceResult;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Throwable;

class UnitService implements IUnitService
{
    protected IUnitRepository $unitRepository;

    public function __construct(IUnitRepository $unitRepository) 
    {
        $this->unitRepository = $unitRepository;
    }

    public function getUnits(): LengthAwarePaginator
    {
        try {
            $units = $this->unitRepository->getUnits();
            return $units;

        } catch (Throwable $e) {
            Log::error('Erro ao listar unidades: '.$e->getMessage());
            throw $e;
        }
    }

    public function getUnitsByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        try {
            $units = $this->unitRepository->getUnitsByFilter($filterDto);
            $unitsAggregate = UnitAggregateMapper::map($units);
            
            return $unitsAggregate;
        } catch (Throwable $e) {
            Log::error('Erro ao filtrar usuários: '.$e->getMessage());
            throw $e;
        }
    }

    public function getUnitById(int $id): Unit
    {
        try {
            $unit = $this->unitRepository->getUnitById($id);
            return $unit;

        } catch (Throwable $e) {
            Log::error('Erro ao obter unidade por ID: '.$e->getMessage());
            throw $e;
        }
    }
    
    public function create(UnitDto $unitDto): ServiceResult
    {
        try {
            $unit = $this->unitRepository->create($unitDto);

            return ServiceResult::ok(
                data: $unit,
                message: 'Unidade criada com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao criar unidade: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao criar unidade');
        }
    }
    
    public function update(UnitDto $unitDto, int $id): ServiceResult
    {
        try {
            $this->unitRepository->update($unitDto, $id);

            return ServiceResult::ok(
                message: 'Unidade atualizada com sucesso'
            );

        } catch (Throwable $e) {
            Log::error('Erro ao atualizar unidade: '.$e->getMessage());
            return ServiceResult::fail('Ocorreu um erro ao atualizar unidade');
        }
    }
    
    public function delete(int $id): ServiceResult
    {
        try {
            $this->unitRepository->delete($id);

            return ServiceResult::ok(
                message: 'Unidade removida com sucesso'
            );
        } catch (Throwable $e) {
            Log::error('Erro ao remover unidade: '.$e->getMessage());
            return ServiceResult::fail('Erro ao remover unidade');
        }
    }
}
