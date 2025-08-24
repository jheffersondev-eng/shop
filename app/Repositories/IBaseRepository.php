<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id);

    /**
     * @param array $filter
     * @return IBaseRepository
     */
    public function findBy(array $filter);

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id);

    /**
     * @return Collection
     */
    public function get();

    /**
     * @param string $column
     * @param string|null $direction
     * @return Model
     */
    public function order(string $column, string $direction = 'asc');

    /**
     * Pagina os resultados.
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage);

    /**
     * @return mixed
     */
    public function includeTrashed();

    /**
     * @return mixed
     */
    public function removeTrashed();
}
