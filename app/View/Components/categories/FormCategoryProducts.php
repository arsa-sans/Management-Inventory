<?php

namespace App\View\Components\categories;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CategoryProduct;

class FormCategoryProducts extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $name, $action;
    public function __construct($id = null)
    {
        if($id){
            $category = CategoryProduct::findOrFail($id);
            $this->id = $category->id;
            $this->name = $category->name;
            $this->action = route('master-data.categories.update', $category->id);
        } else {
            $this->action = route('master-data.categories.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories.form-category-products');
    }
}
