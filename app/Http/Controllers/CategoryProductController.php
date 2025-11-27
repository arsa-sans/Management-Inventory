<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Requests\storeCategoryProductRequest;

class CategoryProductController extends Controller
{
    public $pageTitle = 'Category Products';

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = $this->pageTitle;
        $perPage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $query = CategoryProduct::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $categories = $query->paginate($perPage)->appends(request()->query());
        confirmDelete('Are you sure to delete this category product?');
        $action = route('master-data.categories.store');
        return view('categories.index', compact('pageTitle', 'categories', 'action'));
    }

    public function store(storeCategoryProductRequest $request)
    {
        CategoryProduct::create($request->validated());
        toast()->success('Category Product created successfully');;
        return redirect()->route('master-data.categories.index');
    }

    public function update(storeCategoryProductRequest $request, CategoryProduct $category)
    {
        $category->update($request->validated());
        toast()->success('Category Product updated successfully');;
        return redirect()->route('master-data.categories.index');
    }

    public function destroy(CategoryProduct $category)
    {
        $category->delete();
        toast()->success('Category Product deleted successfully');;
        return redirect()->route('master-data.categories.index');
    }
}
