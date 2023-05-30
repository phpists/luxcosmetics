<?php

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

Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('products/{alias}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
