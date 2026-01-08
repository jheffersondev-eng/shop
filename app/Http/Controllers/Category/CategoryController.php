<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\FilterRequest;
use App\Services\Category\ICategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends BaseController
{
    protected ICategoryService $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(FilterRequest $filterRequest): View
    {
        $categories = $this->categoryService->getCategoriesByFilter($filterRequest->getDto());

        return view('category.index', [
            'url' => route('category.index'),
            'title' => 'Categorias',
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        return view('category.create', [
            'url' => route('category.index'),
        ]);
    }

    public function edit(int $id): View
    {
        $category = $this->categoryService->getCategoryById($id);

        return view('category.edit', [
            'url' => route('category.index'),
            'category' => $category,
        ]);
    }

    public function store(CategoryRequest $categoryRequest): RedirectResponse
    {
        $dto = $categoryRequest->getDto();

        return $this->execute(
            callback: fn() => $this->categoryService->create($dto),
            defaultSuccessMessage: 'Categoria criada com sucesso',
            successRedirect: route('category.index'),
        );
    }

    public function update(CategoryRequest $categoryRequest, int $id): RedirectResponse
    {
        $dto = $categoryRequest->getDto();

        return $this->execute(
            callback: fn() => $this->categoryService->update($dto, $id),
            defaultSuccessMessage: 'Categoria atualizada com sucesso',
            successRedirect: route('category.index'),
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->execute(
            callback: fn() => $this->categoryService->delete($id),
            defaultSuccessMessage: 'Categoria removida com sucesso',
            successRedirect: route('category.index'),
        );
    }
}
