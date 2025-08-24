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

    /**
     * @var Model|Builder
     */
    protected Model|Builder $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model->newQuery();
    }

    /**
     * Cria um novo registro.
     * @param array $columns
     * @return Model
     */
    protected function create(array $columns)
    {
        return $this->model->getModel()->create($columns);
    }

    /**
     * Atualiza um registro.
     * @param int $id
     * @param array $columns
     * @return bool
     */
    protected function update(int $id, array $columns)
    {
        $instance = $this->find($id);
        return $instance ? $instance->update($columns) : false;
    }

    /**
     * Busca um registro pelo ID.
     * @param int $id
     * @return Model|null
     */
    public function find(int $id)
    {
        return $this->model->getModel()->find($id);
    }

    /**
     * Remove um registro pelo ID.
     * @param int $id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id)
    {
        $instance = $this->find($id);
        return $instance ? $instance->delete() : null;
    }

    /**
     * Aplica filtros à query.
     * @param array $filter
     * @return $this
     * @throws Exception
     */
    public function findBy(array $filter)
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

    /**
     * Inclui registros removidos (soft delete).
     * @return $this
     */
    public function includeTrashed()
    {
        $this->model = $this->model->withTrashed();
        return $this;
    }

    /**
     * Remove registros removidos (soft delete) da query.
     * @return $this
     */
    public function removeTrashed()
    {
        $this->model = $this->model->withoutTrashed();
        return $this;
    }

    /**
     * Retorna todos os registros filtrados.
     * @return Collection
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * Ordena a query.
     * @param string $column
     * @param string|null $direction
     * @return $this
     */
    public function order(string $column, string $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    /**
     * Pagina os resultados.
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage)
    {
        return $this->model->paginate($perPage);
    }
}
