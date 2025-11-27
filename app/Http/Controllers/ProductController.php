<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeProductRequest;
use App\Models\Product;
use App\Models\CategoryProduct;

class ProductController extends Controller
{
    public $pageTitle = 'Data Products';

    public function index()
    {
        $query = Product::query();
        $perPage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $pageTitle = $this->pageTitle;

        $query->with('category:id,name');

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $products = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends(request()->query());
        confirmDelete('Are you sure to delete this product?');
        $action = route('master-data.products.store');
        $categories = CategoryProduct::all(['id', 'name']); // Fetch all categories for the dropdown

        return view('product.index', compact('products', 'pageTitle', 'action', 'categories'));
    }

    public function store(storeProductRequest $request)
    {
        $product = Product::create($request->validated());
        toast()->success('Product created successfully.');
        return redirect()->route('master-data.products.show', $product->id);
    }

    public function update(storeProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        toast()->success('Product updated successfully.');
        return redirect()->route('master-data.products.index');
    }

    public function show(Product $product)
    {
        $pageTitle = $this->pageTitle;
        return view('product.show', compact('product', 'pageTitle'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        toast()->success('Product deleted successfully.');
        return redirect()->route('master-data.products.index');
    }
}
