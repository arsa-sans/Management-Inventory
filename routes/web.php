<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Models\User;

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
    });
});
