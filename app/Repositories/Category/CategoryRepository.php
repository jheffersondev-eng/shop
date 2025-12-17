<?php

namespace App\Repositories\Category;

use App\Http\Dto\Category\CategoryDto;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function getCategories(): LengthAwarePaginator
    {
        return $this->model->paginate(10);
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
