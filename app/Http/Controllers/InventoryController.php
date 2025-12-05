<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VarianProduct;
use App\Models\Product;
use App\Models\CategoryProduct;

class InventoryController extends Controller
{
    public $pageTitle = 'Inventory';
    public function index()
    {
        $pageTitle = $this->pageTitle;
        $perPage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $reqCategory = request()->query('category');

        $query = VarianProduct::query();
        $category = CategoryProduct::all();
        $query->with('product', 'product.category');

        if($search) {
            $query->where('varian_name', 'like', '%' . $search . '%')
            ->orWhere('no_sku', 'like', '%' . $search . '%')
            ->orWhereHas('product', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if($reqCategory) {
            $query->whereHas('product', function($query) use ($reqCategory) {
                $query->where('category_id', $reqCategory);
            });
        }

        $paginator = $query->paginate($perPage)->appends(request()->query());
        $product = $paginator->getCollection()->map(function ($q) {
            return [
                'id' => $q->id,
                'no_sku' => $q->no_sku,
                'product_name' => $q->product->name . ' - ' . $q->varian_name,
                'category_name' => $q->product->category->name,
                'stock' => $q->stock,
                'price' => $q->price,
            ];
        });

        $paginator->setCollection($product);
        $product = $paginator;

        return view('inventory.index', compact('pageTitle', 'product', 'category'));
    }
}
