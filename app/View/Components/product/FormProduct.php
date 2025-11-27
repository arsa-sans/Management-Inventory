<?php

namespace App\View\Components\product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use App\Models\CategoryProduct;

class FormProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $name, $description, $category, $action, $category_id;
    public function __construct($id = null)
    {
        $this->category = CategoryProduct::all();
        if ($id){
            $product = Product::findOrFail($id);
            $this->id = $product->id;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->action = route('master-data.products.update', $product->id);
        } else {
            $this->action = route('master-data.products.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.form-product');
    }
}
