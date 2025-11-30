<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryProduct;
use App\Models\VarianProduct;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
    ];
    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
    public function varian()
    {
        return $this->hasMany(VarianProduct::class);
    }
}
