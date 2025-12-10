<?php

namespace App\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    const WHERE_TAGS = 'In,Like';

    protected Model|Builder $model;

    public function __construct(Model $model)
    {
        $this->model = $model->newQuery();
    }

    protected function createBase(array $columns): Model
    {
        return $this->model->getModel()->create($columns);
    }

    protected function updateBase(int $id, array $columns): bool
    {
        $instance = $this->find($id);
        return $instance ? $instance->update($columns) : false;
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
        return $this->model->get();
    }

    public function order(string $column, string $direction = 'asc'): self
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }
}
