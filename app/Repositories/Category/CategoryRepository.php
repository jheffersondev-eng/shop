<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function getCategories()
    {
        return $this->model->withoutTrashed()->get();
    }

    public function getCategoryById($id)
    {
        return $this->model->withoutTrashed()->find($id);
    }

    public function store($request)
    {
        $data = method_exists($request, 'validated') ? $request->validated() : $request->all();
        $this->model->getModel()->create($data);
    }

    public function updateCategory($id, array $data)
    {
        $category = $this->getCategoryById($id);
        if ($category) {
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }
}
