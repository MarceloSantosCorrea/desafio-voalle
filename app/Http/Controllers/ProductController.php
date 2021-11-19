<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    use TraitCrud;

    /**
     * @var Model
     */
    private $model = Product::class;
    private $route = 'products';
    private $data = [];

    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $this->model::query()->create($request->all());

        return redirect()->route('products.index')->with('success', __(':attribute created successfully', [
            'attribute' => __('Product'),
        ]));
    }

    public function edit(Product $product)
    {
        return view('pages.products.update', compact('product'));
    }

    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', __(':attribute updated successfully', [
            'attribute' => __('Product'),
        ]));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', __(':attribute deleted successfully', [
            'attribute' => __('Product'),
        ]));
    }
}
