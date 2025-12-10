<?php

namespace App\Http\Controllers\Product;

use App\Enums\EIsActive;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Category\ICategoryRepository;
use App\Repositories\Product\IProductRepository;
use App\Repositories\Unit\IUnitRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends BaseController
{
    protected ICategoryRepository $categoryRepository;
    protected IUnitRepository $unitRepository;

    public function __construct(
        ICategoryRepository $categoryRepository, 
        IUnitRepository $unitRepository,
        IProductRepository $productRepository)
    {
        parent::__construct($productRepository);

        $this->categoryRepository = $categoryRepository;
        $this->unitRepository = $unitRepository;

        $this->setPages(10);
        $this->setName('Produtos');
        $this->setUrl(url('product'));
        $this->setFolderView('product');
        $this->setOrderList(['id', 'asc']);
        $this->setModels('products');
    }

    public function Index(Request $request)
    {
        return parent::IndexBase($request);
    }

    public function Create(): View
    {
        $categories = $this->categoryRepository->getCategories();
        $units = $this->unitRepository->getUnits();

        return view($this->getFolderView() . '.create')->with([
            'url' => $this->getUrl(),
            'categories' => $categories,
            'units' => $units,
            'isActive' => EIsActive::class,
        ]);
    }

    public function Store(ProductRequest $request): RedirectResponse
    {
        return parent::StoreBase($request);
    }


    public function Edit($id): View|RedirectResponse
    {
        $product = $this->repository->findWithoutTrashed($id);
        if (!$product) {
            return redirect()->route('product.index')
                ->with('error', $this->getName() . ' não encontrado.');
        }

        $categories = $this->categoryRepository->getCategories();
        $units = $this->unitRepository->getUnits();

        return view($this->getFolderView() . '.edit')->with([
            'url' => $this->getUrl(),
            'product' => $product,
            'categories' => $categories,
            'units' => $units,
            'isActive' => EIsActive::class,
        ]);
    }

    public function Update(ProductUpdateRequest $productUpdateRequest, Product $product): RedirectResponse
    {
        return parent::UpdateBase($product, $productUpdateRequest);
    }
}