<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->setPages(10);
        $this->setName('Produtos');
        $this->setUrl(url('product'));
        $this->setFolderView('product');
        $this->setOrderList(['id', 'asc']);
    }

    public function Index(): View
    {
        $products = Product::withoutTrashed()->get();
        return view($this->getFolderView() . '.index', [
            'url' => $this->getUrl(),
            'title' => $this->getName(),
            'products' => $products,
        ]);
    }

    public function Create(): View
    {
        $categories = Category::withoutTrashed()->get();
        return view($this->getFolderView() . '.create', [
            'url' => $this->getUrl(),
            'categories' => $categories,
        ]);
    }

    public function Store(Request $request): RedirectResponse
    {
        $data = $request->only([
            'name', 'description', 'category_id', 'price', 'stock_quantity'
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->route('product.index');
    }
}