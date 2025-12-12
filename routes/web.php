<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Http\Controllers\VarianProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CardStockController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// master data
Route::middleware(['auth'])->group(function () {
    Route::prefix('master-data')->name('master-data.')->group(function () {
        Route::resource('categories', CategoryProductController::class);
        Route::resource('products', ProductController::class);
        Route::resource('varian-products', VarianProductController::class)->only(['store', 'update', 'destroy']);
        Route::resource('inventories', InventoryController::class)->only('index');
    });

    Route::get('/card-stock/{no_sku}',[CardStockController::class, 'cardStock'])->name('card-stock.cardStock');
});
