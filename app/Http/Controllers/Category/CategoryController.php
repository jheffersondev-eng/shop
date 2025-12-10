<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Repositories\Category\ICategoryRepository;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function __construct(ICategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);

        $this->setPages(10);
        $this->setName('Categoria');
        $this->setUrl(url('category'));
        $this->setFolderView('category');
        $this->setOrderList(['id', 'asc']);
        $this->setModels('categories');
    }

    public function Index(Request $request)
    {
        return parent::IndexBase($request);
    }

    public function Create()
    {
        return parent::CreateBase();
    }

    public function Store(Request $request)
    {
        return parent::StoreBase($request);
    }

    public function Edit($id)
    {
        $category = $this->repository->findWithoutTrashed($id);
        return parent::EditBase($category)->with('category', $category);
    }

    public function Update(Request $request, int $id)
    {
        $data = $request->all();
        $this->repository->updateCategory($id, $data);
        return redirect()->route('category.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function Destroy(Request $request, int $id)
    {
        $category = $this->repository->find($id);
        return parent::DestroyBase($category, $request);
    }
}
