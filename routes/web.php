<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Models\Phone;

/* Socialize */
Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Categories
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/{alias}', [CategoryController::class, 'show'])->name('categories.show');
// Search
Route::get('/search_prompt', [\App\Http\Controllers\SearchController::class, 'search_prompt'])->name('search_prompt');
// Products
Route::get('products/{alias}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::get('products/{alias}/{variation_id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::get('faq', [FaqController::class, 'index'])->name('faq');
Route::get('brands', [\App\Http\Controllers\BrandController::class, 'index'])->name('brands');
Route::get('favourites', [\App\Http\Controllers\FavouritesController::class, 'index'])->name('favourites');
Route::get('sales', [\App\Http\Controllers\SalesController::class, 'index'])->name('sales');
Route::group(['middleware' => 'auth'], function () {
    Route::post('create-chat', [\App\Http\Controllers\FeedbackController::class, 'store'])->name('create-chat');
    Route::put('update-chat/{id}', [\App\Http\Controllers\FeedbackController::class, 'update'])->name('update-chat');
    Route::post('send-message', [\App\Http\Controllers\FeedbackController::class, 'store_message'])->name('send-message');
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

    /* Menu */
    Route::get('menu/{menu_type}', [MenuController::class, 'index'])->name('admin.menu');
//    Route::get('menu/show-all-parents', [MenuController::class, 'showAllParents'])->name('admin.menu.show_all_parents');
    Route::post('menu/store', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::get('menu/create/{menu_type}', [MenuController::class, 'create'])->name('admin.menu.create');
    Route::get('menu/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
//    Route::get('menu/show', [MenuController::class, 'showMenu'])->name('admin.menu.show');
    Route::put('menu/update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::get('menu/delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');
    Route::post('menu/update-positions', [MenuController::class, 'updatePosition'])->name('admin.menu.updatePosition');


    /* Menu Category */
    Route::post('menu/category/store', [MenuCategoryController::class, 'storeMenuCategory'])->name('admin.menu.category.store');
    Route::post('menu/category/images/store', [MenuController::class, 'storeMenuImages'])->name('admin.menu.images.store');
    Route::get('menu/category/show', [MenuCategoryController::class, 'showMenuCategory'])->name('admin.menu.category.show');
    Route::post('menu/category/update', [MenuCategoryController::class, 'updateMenuCategory'])->name('admin.menu.category.update');
    Route::delete('menu/category/delete', [MenuCategoryController::class, 'deleteMenuCategory'])->name('admin.menu.category.delete');
    Route::post('menu/category/update-positions', [MenuCategoryController::class, 'updatePositionMenuCategory'])->name('admin.menu.update_positions');


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
    Route::post('categories/update-position', [AdminCategoryController::class, 'updatePosition'])->name('admin.categories.updatePosition');
    Route::post('_update-properties-position', [AdminCategoryController::class, 'updatePropertiesPosition'])->name('admin.categories.updatePropsPosition');
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
    Route::get('settings/telephone/edit/', [App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'edit'])->name('admin.settings.telephone.edit');
    Route::put('settings/telephone/update/', [App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'updateTelephone'])->name('admin.settings.telephone.update');

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

    // Feedback Chat
    Route::get('chats', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('admin.chats');
    Route::get('chats/{id}/edit', [\App\Http\Controllers\Admin\FeedbackController::class, 'edit'])->name('admin.chats.edit');

    /* News */
    Route::get('newses', [\App\Http\Controllers\Admin\News\NewsController::class, 'index'])->name('admin.news');
    Route::get('news', [\App\Http\Controllers\Admin\News\NewsController::class, 'create'])->name('admin.news.create');
    Route::post('news', [\App\Http\Controllers\Admin\News\NewsController::class, 'store'])->name('admin.news.store');
    Route::get('news/edit/{id}', [\App\Http\Controllers\Admin\News\NewsController::class, 'edit'])->name('admin.news.edit');
    Route::post('news/update', [\App\Http\Controllers\Admin\News\NewsController::class, 'update'])->name('admin.news.update');
    Route::post('news/update/seo', [\App\Http\Controllers\Admin\News\NewsController::class, 'updateSeo'])->name('admin.news.update.seo');
    Route::get('news/delete/{id}', [\App\Http\Controllers\Admin\News\NewsController::class, 'delete'])->name('admin.news.delete');

    /* News Operation */
    Route::post('_delete-posts', [\App\Http\Controllers\Admin\News\NewsController::class, 'deletePosts']);
    Route::post('_active-posts', [\App\Http\Controllers\Admin\News\NewsController::class, 'activePosts']);

    /* Blog */
    Route::get('blogs', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'index'])->name('admin.blog');
    Route::get('blog', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('blog', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('blog/edit/{id}', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('blog/update', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'update'])->name('admin.blog.update');
    Route::post('blog/update/seo', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'updateSeo'])->name('admin.blog.update.seo');
    Route::get('blog/delete/{id}', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'delete'])->name('admin.blog.delete');

    /* Blog Operation */
    Route::post('_delete-posts', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'deletePosts']);
    Route::post('_active-posts', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'activePosts']);

    // Properties
    Route::get('properties', [\App\Http\Controllers\Admin\PropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('properties/create', [\App\Http\Controllers\Admin\PropertyController::class, 'create'])->name('admin.properties.create');
    Route::post('properties', [\App\Http\Controllers\Admin\PropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('properties/{id}/edit', [\App\Http\Controllers\Admin\PropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::put('properties/{id}', [\App\Http\Controllers\Admin\PropertyController::class, 'update'])->name('admin.properties.update');
    Route::delete('properties/{id}', [\App\Http\Controllers\Admin\PropertyController::class, 'delete'])->name('admin.properties.delete');

});

Route::get('/news/new/{id}', [\App\Http\Controllers\NewsController::class, 'show'])->name('index.news');
Route::get('/blog/blog/{id}', [\App\Http\Controllers\BlogController::class, 'show'])->name('index.blog');

Route::get('/user/home', [App\Http\Controllers\HomeController::class, 'home'])->name('user.home');
