<?php

namespace App\Repositories\Category;

use App\Http\Dto\Category\CategoryDto;
use App\Http\Dto\Category\FilterDto;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    const PAGINATION_SIZE = 10;

    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function getCategories(): LengthAwarePaginator
    {
        return $this->model->paginate(10);
    }

    public function getCategoriesByFilter(FilterDto $filterDto): LengthAwarePaginator
    {
        $query = DB::table('categories as c')
            ->select(
                    'c.id',
                    'c.name',
                    'c.description',
                    'c.created_at',
                    'c.updated_at'
                );

        $query = $this->applyFilters($query, $filterDto);

        return $query->paginate(self::PAGINATION_SIZE);
    }

    private function applyFilters($query, FilterDto $filterDto)
    {
        if ($filterDto->id) {
            $query->where('id', $filterDto->id);
        }

        if ($filterDto->name) {
            $query->where('name', 'like', '%'.$filterDto->name.'%');
        }

        if ($filterDto->dateDe) {
            $query->where('created_at', '>=', $filterDto->dateDe);
        }

        if ($filterDto->dateAte) {
            $query->where('created_at', '<=', $filterDto->dateAte);
        }

        return $query;
    }

    public function getCategoryById(int $id): Category
    {
        $category = $this->model->find($id);

        if (!$category) {
            throw new Exception("Categoria não encontrada.");
        }

        return $category;
    }

    public function create(CategoryDto $categoryDto): Category
    {
        $data = [
            'name' => $categoryDto->name,
            'description' => $categoryDto->description,
        ];

        return $this->model->create($data);
    }

    public function update(CategoryDto $categoryDto, int $id)
    {
        $category = $this->model->find($id);

        if (!$category) {
            throw new Exception("Categoria não encontrada.");
        }
        
        $data = [
            'name' => $categoryDto->name,
            'description' => $categoryDto->description,
        ];

        return $category->update($data);
    }

    public function delete(int $id)
    {
        $category = $this->model->find($id);

        if (!$category) {
            throw new Exception("Categoria não encontrada.");
        }

        return $category->delete();
    }
}
