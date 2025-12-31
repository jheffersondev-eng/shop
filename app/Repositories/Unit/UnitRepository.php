<?php

namespace App\Repositories\Unit;

use App\Http\Dto\Unit\FilterDto;
use App\Http\Dto\Unit\UnitDto;
use App\Models\Unit;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnitRepository extends BaseRepository implements IUnitRepository
{
    const PAGINATION_SIZE = 10;
    protected int $userLoggedId;
    protected int $ownerId;

    public function __construct()
    {
        parent::__construct(new Unit());
        $this->userLoggedId = Auth::id();
        $this->ownerId = Auth::user()->owner_id;
    }

    public function getUnits(): LengthAwarePaginator
    {
        return $this->model->where('user_id_created', '=', $this->userLoggedId)
            ->paginate(self::PAGINATION_SIZE);
    }

    public function getUnitsByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        $query = DB::table('units as u')
            ->leftJoin('users as uc', 'u.user_id_created', '=', 'uc.id')
            ->leftJoin('users as uu', 'u.user_id_updated', '=', 'uu.id')
            ->leftJoin('user_details as udc', 'uc.id', '=', 'udc.user_id')
            ->leftJoin('user_details as udu', 'uu.id', '=', 'udu.user_id')
            ->select(
                    'u.id as id',
                    'u.name as name',
                    'u.abbreviation as abbreviation',
                    'u.format as format',
                    'u.user_id_created as user_id_created',
                    'u.user_id_updated as user_id_updated',
                    'udc.name as user_created_name',
                    'udu.name as user_updated_name',
                    'u.created_at as created_at',
                    'u.updated_at as updated_at',
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, $filterDto)
    {
        $query->whereNull('u.deleted_at')
            ->where(function($q) {
                $q->where('u.user_id_created', '=', $this->userLoggedId)
                    ->orWhere('u.owner_id', '=', $this->ownerId);
            });

        $query->whereNull('u.deleted_at');

        if ($filterDto->id) {
            $query->where('u.id', $filterDto->id);
        }

        if ($filterDto->name) {
            $query->where('u.name', 'like', '%'.$filterDto->name.'%');
        }

        if ($filterDto->abbreviation) {
            $query->where('u.abbreviation', 'like', '%'.$filterDto->abbreviation.'%');
        }

        if ($filterDto->format) {
            $query->where('u.format', $filterDto->format);
        }

        if ($filterDto->dateDe) {
            $query->whereDate('u.created_at', '>=', $filterDto->dateDe->toDateString());
        }

        if ($filterDto->dateAte) {
            $query->whereDate('u.created_at', '<=', $filterDto->dateAte->toDateString());
        }

        return $query;
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
            'user_id_created' => $this->userLoggedId,
            'owner_id' => $this->ownerId,
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
            'user_id_updated' => $this->userLoggedId,
        ];
        
        return $this->model->update($data);
    }

    public function delete(int $id)
    {
        $unit = $this->model->find($id);
        
        if (!$unit) {
            throw new Exception("Unidade não encontrada.");
        }

        $unit->user_id_deleted = $this->userLoggedId;
        $unit->deleted_at = now();
        
        return $unit->save();
    }
}
