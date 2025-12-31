<?php

namespace App\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseRepository implements IBaseRepository
{
    const WHERE_TAGS = 'In,Like';

    protected Model|Builder $model;

    public function __construct(Model $model)
    {
        $this->model = $model->newQuery();
    }

    public function find(int $id): ?Model
    {
        return $this->model->getModel()->find($id);
    }

    public function findWithoutTrashed(int $id): ?Model
    {
        return $this->model->withoutTrashed()->find($id);
    }

    public function findBy(array $filter): self
    {
        // Filter by owner_id automatically for tenant-aware models
        if ($this->shouldFilterByOwner()) {
            $ownerId = Auth::user()->owner_id ?? Auth::id();
            $this->model = $this->model->where('owner_id', $ownerId);
        }

        $tagsArray = explode(',', self::WHERE_TAGS);

        foreach ($filter as $column => $value) {
            if (empty($value) || $column == 'page') {
                continue;
            }

            $noTag = true;
            foreach ($tagsArray as $tag) {
                $type = strstr($column, $tag);
                if (empty($type)) {
                    continue;
                } else {
                    $str = strstr($column, $tag, true);
                    $chars = preg_split(
                        '/([[:upper:]][[:lower:]]+)/',
                        $str,
                        -1,
                        PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY
                    );
                    $column = strtolower(implode('_', $chars));

                    if ($type == 'In') {
                        if (!is_array($value)) {
                            throw new Exception('Esse tipo de filtro só é permitido para variáveis do tipo array');
                        }
                        $this->model = $this->model->whereIn($column, $value);
                    }

                    if ($type == 'Like') {
                        $this->model = $this->model->where($column, 'like', "%{$value}%");
                    }
                    $noTag = false;
                    break;
                }
            }

            if ($noTag) {
                $this->model = $this->model->where($column, $value);
            }
        }

        return $this;
    }

    /**
     * Check if the model should be filtered by owner_id
     * Models that have the owner_id column and use the HasOwner trait should be filtered
     */
    private function shouldFilterByOwner(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        // Get the model table name
        $table = $this->model->getModel()->getTable();
        
        // Tables that should be filtered by owner_id
        $tenantAwareTables = [
            'users',
            'products',
            'categories',
            'units',
            'profiles',
            'permissions',
            'sales',
        ];

        return in_array($table, $tenantAwareTables);
    }

    public function includeTrashed(): self
    {
        $this->model = $this->model->withTrashed();
        return $this;
    }

    public function removeTrashed(): self
    {
        $this->model = $this->model->withoutTrashed();
        return $this;
    }

    public function get(): Collection
    {
        // Filter by owner_id automatically for tenant-aware models
        if ($this->shouldFilterByOwner()) {
            $ownerId = auth()->user()->owner_id ?? auth()->id();
            $this->model = $this->model->where('owner_id', $ownerId);
        }

        return $this->model->get();
    }

    public function order(string $column, string $direction = 'asc'): self
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        // Filter by owner_id automatically for tenant-aware models
        if ($this->shouldFilterByOwner()) {
            $ownerId = auth()->user()->owner_id ?? auth()->id();
            $this->model = $this->model->where('owner_id', $ownerId);
        }

        return $this->model->paginate($perPage);
    }
}
