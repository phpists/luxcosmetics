<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

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
})->name('home');
// Categories
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/{alias}', [CategoryController::class, 'show'])->name('categories.show');
// Products
Route::get('products/{alias}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::get('products/{alias}/{variation_id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
// Profile
Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/order-history', [\App\Http\Controllers\ProfileController::class, 'order_history'])->name('profile.order-history');
    Route::get('/subscriptions', [\App\Http\Controllers\ProfileController::class, 'subscriptions'])->name('profile.subscriptions');
    Route::get('/addresses', [\App\Http\Controllers\ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/payment-methods', [\App\Http\Controllers\ProfileController::class, 'payment_methods'])->name('profile.payment-methods');
    Route::get('/gift-cards', [\App\Http\Controllers\ProfileController::class, 'gift_cards'])->name('profile.gift-cards');
    Route::get('/bonuses', [\App\Http\Controllers\ProfileController::class, 'bonuses'])->name('profile.bonuses');
    Route::get('/password', [\App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
    Route::get('/support', [\App\Http\Controllers\ProfileController::class, 'support'])->name('profile.support');
    Route::get('/logout', [\App\Http\Controllers\ProfileController::class, 'logout'])->name('profile.logout');
    Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
});
// Cart
Route::get('cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::get('cart/step1', [\App\Http\Controllers\CartController::class, 'step_first'])->name('cart.step1');
Route::get('cart/step2', [\App\Http\Controllers\CartController::class, 'step_second'])->name('cart.step2');
// Gift cards
Route::get('giftcards/create', [\App\Http\Controllers\GiftController::class, 'create'])->name('gift-cards.create');
Route::get('giftcards/{alias}', [\App\Http\Controllers\GiftController::class, 'show'])->name('gift-cards.show');
// Admin
Route::get('admin', [AdminController::class, 'index'])->name('admin.home');
Route::group(['prefix' => 'admin'], function () {
//    Product Images
    Route::get('products/image/{id}/remove', [\App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('admin.product.image.remove');
    Route::post('products/image', [\App\Http\Controllers\Admin\ProductController::class, 'storeImage'])->name('admin.product.image.store');
    Route::put('products/image', [\App\Http\Controllers\Admin\ProductController::class, 'updateImage'])->name('admin.product.image.update');
//    Product Variation
    Route::get('products/variation/{id}/remove', [\App\Http\Controllers\Admin\ProductController::class, 'deleteVariation'])->name('admin.product.variation.remove');
    Route::get('products/variation/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'showVariation'])->name('admin.product.variation.show');
    Route::post('products/variation', [\App\Http\Controllers\Admin\ProductController::class, 'storeVariation'])->name('admin.product.variation.store');
    Route::put('products/variation', [\App\Http\Controllers\Admin\ProductController::class, 'updateVariation'])->name('admin.product.variation.update');
//    Product
    Route::get('products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
    Route::post('products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::delete('products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('admin.product.delete');
    Route::get('products/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::get('products/edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
//    Categories
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::post('categories', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('categories/remove/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    Route::put('categories', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
//    Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('clear-cache', [SettingController::class, 'clearCache'])->name('admin.clear.cache');
    Route::post('logout')->name('logout');
//    Images
    Route::get('images/show', [\App\Http\Controllers\Admin\ImageController::class, 'show'])->name('admin.image.show');

    /* Categories Operation */
    Route::post('_delete-categories', [AdminCategoryController::class, 'deleteCategories']);
    Route::post('_active-categories', [AdminCategoryController::class, 'activeCategories']);

    Route::post('_delete-products', [\App\Http\Controllers\Admin\ProductController::class, 'deleteProducts']);
//    Route::post('_active-products', [\App\Http\Controllers\Admin\ProductController::class, 'activeProducts']);
});
