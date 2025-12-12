<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardStock;
use App\Http\Resources\CardStockResource;

class CardStockController extends Controller
{
    public function cardStock($no_sku) {
        $query = CardStock::where('no_sku', $no_sku)->orderBy('created_at', 'desc')->paginate(1);
        return CardStockResource::collection($query);
    }
}
