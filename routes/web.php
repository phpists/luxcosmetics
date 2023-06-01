<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/{alias}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('products/{alias}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::get('products/{alias}/{variation_id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
});
