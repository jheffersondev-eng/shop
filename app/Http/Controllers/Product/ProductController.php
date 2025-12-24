<?php

namespace App\Http\Controllers\Product;

use App\Enums\EIsActive;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Services\Category\ICategoryService;
use App\Services\Product\IProductService;
use App\Services\UnitService\IUnitService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends BaseController
{
    protected IProductService $productService;
    protected ICategoryService $categoryService;
    protected IUnitService $unitService;

    public function __construct(
        IProductService $productService,
        ICategoryService $categoryService,
        IUnitService $unitService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->unitService = $unitService;
    }

    public function Index(FilterRequest $filterRequest): View
    {
        $products = $this->productService->getProductsByFilter($filterRequest->getDto());
        $categories = $this->categoryService->getCategories();
        $units = $this->unitService->getUnits();
        $isActive = EIsActive::toArrayOptions();

        return view('product.index', [
            'url' => route('product.index'),
            'title' => 'Produtos',
            'products' => $products,
            'categories' => $categories,
            'units' => $units,
            'isActive' => $isActive,
        ]);
    }

    public function Create(): View
    {
        $categories = $this->categoryService->getCategories();
        $units = $this->unitService->getUnits();
        $isActive = EIsActive::toArrayOptions();

        return view('product.create', [
            'url' => route('product.index'),
            'categories' => $categories,
            'units' => $units,
            'isActive' => $isActive,
        ]);
    }

    public function Edit(int $id): View
    {
        $product = $this->productService->getProductById($id);
        $categories = $this->categoryService->getCategories();
        $units = $this->unitService->getUnits();
        $isActive = EIsActive::toArrayOptions();

        return view('product.edit', [
            'url' => route('product.index'),
            'product' => $product,
            'categories' => $categories,
            'units' => $units,
            'isActive' => $isActive,
        ]);
    }

    public function Store(ProductRequest $productRequest): RedirectResponse
    {
        $dto = $productRequest->getDto();

        return $this->execute(
            callback: fn() => $this->productService->create($dto),
            defaultSuccessMessage: 'Produto criado com sucesso',
            successRedirect: route('product.index'),
        );
    }

    public function Update(ProductRequest $productRequest, int $id): RedirectResponse
    {
        $dto = $productRequest->getDto();

        return $this->execute(
            callback: fn() => $this->productService->update($dto, $id),
            defaultSuccessMessage: 'Produto atualizado com sucesso',
            successRedirect: route('product.index'),
        );
    }

    public function Destroy(int $id): RedirectResponse
    {
        return $this->execute(
            callback: fn() => $this->productService->delete($id),
            defaultSuccessMessage: 'Produto removido com sucesso',
            successRedirect: route('product.index'),
        );
    }
}