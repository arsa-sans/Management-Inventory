<?php

namespace App\View\Components\product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\VarianProduct;

class FormVarian extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $product_id, $no_sku, $varian_name, $stock, $price, $action;
    public function __construct($id = null)
    {
        $product = request()->route('products');
        $this->product_id = $product ? $product->id : null;
        if($id){
            $varian = VarianProduct::findOrFail($id);
            $this->id = $varian->id;
            $this->varian_name = $varian->varian_name;
            $this->stock = $varian->stock;
            $this->price = $varian->price;
            $this->action = route('master-data.varian-products.update', $varian->id);
        } else {
            $this->action = route('master-data.varian-products.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.form-varian');
    }
}
