<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/* Socialize */
Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Categories
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/{alias}', [CategoryController::class, 'show'])->name('categories.show');
// Products
Route::get('products/{alias}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::get('products/{alias}/{variation_id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::get('faq', [FaqController::class, 'index'])->name('faq');
Route::get('brands', [\App\Http\Controllers\BrandController::class, 'index'])->name('brands');
Route::get('favourites', [\App\Http\Controllers\FavouritesController::class, 'index'])->name('favourites');
Route::get('sales', [\App\Http\Controllers\SalesController::class, 'index'])->name('sales');
Route::group(['middleware' => 'auth'], function () {
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
//        Route::get('/logout', [\App\Http\Controllers\ProfileController::class, 'logout'])->name('profile.logout');
        Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::post('/add-payment-method', [\App\Http\Controllers\ProfileController::class, 'add_payment'])->name('profile.add-payment-method');
        Route::post('/add-address', [\App\Http\Controllers\ProfileController::class, 'add_address'])->name('profile.add-address');
        Route::post('/update-default-address', [\App\Http\Controllers\ProfileController::class, 'update_default_address'])->name('profile.update-default-address');
        Route::post('/reset-password', [\App\Http\Controllers\ProfileController::class, 'reset_password'])->name('profile.reset-password');

    });
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
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
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

    //    Social media
    Route::get('settings/socials', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'index'])->name('admin.settings.socials');
    Route::get('settings/social', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'show'])->name('admin.settings.social.show');
    Route::post('settings/social', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'store'])->name('admin.settings.social.store');
    Route::post('settings/social/update', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'update'])->name('admin.settings.social.update');
    Route::delete('settings/social/drop', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'destroy'])->name('admin.settings.social.destroy');
    Route::post('settings/social/change_status', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'change_status'])->name('admin.settings.social.change_status');
    Route::post('settings/social/update-positions', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'updates_positions'])->name('admin.settings.social.update_positions');

//     Telephone
    Route::get('settings/telephone/edit', [App\Http\Controllers\Admin\Settings\PhoneController::class, 'edit'])->name('admin.settings.telephone.edit');
    Route::patch('settings/telephone/update/{number}', [App\Http\Controllers\Admin\Settings\PhoneController::class, 'update'])->name('admin.settings.telephone.update');

    Route::get('clear-cache', [SettingController::class, 'clearCache'])->name('admin.clear.cache');
    Route::post('logout')->name('logout');
//    Images
    Route::get('images/show', [\App\Http\Controllers\Admin\ImageController::class, 'show'])->name('admin.image.show');

    /* Categories Operation */
    Route::post('_delete-categories', [AdminCategoryController::class, 'deleteCategories']);
    Route::post('_active-categories', [AdminCategoryController::class, 'activeCategories']);
    /* Product Operation */
    Route::post('_delete-products', [\App\Http\Controllers\Admin\ProductController::class, 'deleteProducts']);
    /* Admin Faq */
    Route::get('faqs', [\App\Http\Controllers\Admin\FaqController::class, 'index'])->name('admin.faqs');
    Route::get('faqs/search', [\App\Http\Controllers\Admin\FaqController::class, 'search'])->name('admin.faqs.search');
    Route::post('faqs/update-positions', [\App\Http\Controllers\Admin\FaqController::class, 'updates_positions'])->name('admin.faqs.update_positions');
    Route::get('faq/show', [\App\Http\Controllers\Admin\FaqController::class, 'show'])->name('admin.faq.show');
    Route::post('faq/store', [\App\Http\Controllers\Admin\FaqController::class, 'store'])->name('admin.faq.store');
    Route::post('faq/update', [\App\Http\Controllers\Admin\FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('faq/delete', [\App\Http\Controllers\Admin\FaqController::class, 'delete'])->name('admin.faq.delete');
//    Route::post('_active-products', [\App\Http\Controllers\Admin\ProductController::class, 'activeProducts']);

});

Route::get('/user/home', [App\Http\Controllers\HomeController::class, 'home'])->name('user.home');
