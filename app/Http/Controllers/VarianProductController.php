<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeVarianProductRequest;
use App\Models\VarianProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\updateVarianProductRequest;
use App\Models\CardStock;
use Illuminate\Support\Facades\Auth;

class VarianProductController extends Controller
{
    public function store(storeVarianProductRequest $request)
    {
        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('varian-product', $request->file('image'), $fileName);
        VarianProduct::create([
            'product_id' => $request->product_id,
            'varian_name' => $request->varian_name,
            'no_sku' => VarianProduct::generateSKU(),
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $fileName,
        ]);

        return response()->json(['message' => 'Varian product created successfully.']);
    }

    public function update(updateVarianProductRequest $request, $varian_product)
    {
        $isAdjustment = false;
        $varian = VarianProduct::findOrFail($varian_product);

        if($request->stock != $varian->stock){
            $isAdjustment = true;
        }

        $fileName = $varian->image;

        if($request->hasFile('image')){
            Storage::disk('public')->delete('varian-product/' . $varian->image);
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('varian-product', $request->file('image'), $fileName);
        }

        $varian->update([
            'varian_name' => $request->varian_name,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $fileName,
        ]);

        if($isAdjustment){
            CardStock::create([
                'type_transaction' => 'Adjustment',
                'no_sku' => $varian->no_sku,
                'last_stock' => $varian->stock,
                'officer' => Auth::user()->name,
            ]);
        }

        return response()->json(['message' => 'Varian product updated successfully.']);
    }

    public function destroy($varian_product)
    {
        $varian = VarianProduct::findOrFail($varian_product);
        Storage::disk('public')->delete('varian-product/' . $varian->image);
        $varian->delete();
        toast()->success('Success', 'Varian product deleted successfully.');
        return response()->json(['message' => 'Varian product deleted successfully.']);
    }
}