<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianProduct extends Model
{
    protected $fillable = [
        'product_id',
        'varian_name',
        'no_sku',
        'stock',
        'price',
        'image',
    ];

    public static function generateSKU()
    {
        $maxId = self::max('id');
        $frefix = 'SKU';
        $number = $frefix . str_pad($maxId + 1, 6, '0', STR_PAD_LEFT);
        return $number;
    }
}
