<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryProduct;

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
}
