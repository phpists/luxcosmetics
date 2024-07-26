<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductPriceController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/* Socialize */
Auth::routes();

Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('login_socialite');
Route::match(['get', 'post'], 'login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/auth-facebook/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/auth-facebook/callback', function () {
    $user = Socialite::driver('facebook')->user();

    // $user->token
});

Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPassController::class, 'reset'])->name('password.reset-password');

// Pages brand
Route::get('b', [\App\Http\Controllers\BrandsController::class, 'index'])->name('categories');
Route::get('b/{link}', [\App\Http\Controllers\BrandsController::class, 'show'])->name('brands.show');

// Categories
Route::get('catalog', [CategoryController::class, 'index'])->name('categories');
Route::get('c/{alias}', [CategoryController::class, 'show'])->name('categories.show');
// Product card
Route::get('product/card/{product}', [\App\Http\Controllers\ProductController::class, 'productCard'])->name('product.card');
// Static pages
Route::get('/pages/{alias}', [\App\Http\Controllers\PagesController::class, 'show'])->name('pages.show');
// Search
Route::get('/search_prompt', [\App\Http\Controllers\SearchController::class, 'search_prompt'])->name('search_prompt');
Route::get('/api/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search_products');
Route::get('/api/customSearch', [\App\Http\Controllers\SearchController::class, 'getProductsByBaseValue'])->name('getProductsByBaseValue');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'showResultsPage'])->name('show_search');
// Products
Route::get('p/{alias}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
//Route::get('products/{alias}/{variation_id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.product');
Route::get('q/delivery', [QuestionController::class, 'delivery'])->name('questions.delivery');
Route::get('q/returns', [QuestionController::class, 'returns'])->name('questions.returns');
Route::get('q/policy', [QuestionController::class, 'policy'])->name('questions.policy');
Route::get('q/faq', [QuestionController::class, 'index'])->name('questions.faq');
Route::get('brands', [\App\Http\Controllers\BrandController::class, 'index'])->name('brands');
Route::get('sales', [\App\Http\Controllers\SalesController::class, 'index'])->name('sales');
Route::get('sales-50', [\App\Http\Controllers\SalesController::class, 'index'])->name('sales-50');
Route::get('novinki', [\App\Http\Controllers\SalesController::class, 'index'])->name('novinki');
// Favourite Products
Route::get('favourites/{categoryId?}', [\App\Http\Controllers\FavoriteProductController::class, 'index'])->name('favourites');
Route::post('favourites', [\App\Http\Controllers\FavoriteProductController::class, 'add'])->name('favourites.add');
Route::delete('favourites', [\App\Http\Controllers\FavoriteProductController::class, 'remove'])->name('favourites.remove');
// Ask product question
Route::post('product_question', [\App\Http\Controllers\ProductQuestionController::class, 'createQuestion'])->name('product_question.create');
Route::group(['middleware' => 'auth'], function () {
    Route::post('create-chat', [\App\Http\Controllers\FeedbackController::class, 'store'])->name('create-chat');
    Route::put('update-chat/{id}', [\App\Http\Controllers\FeedbackController::class, 'update'])->name('update-chat');
    Route::post('send-message', [\App\Http\Controllers\FeedbackController::class, 'store_message'])->name('send-message');
    // Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        Route::get('/orders', [\App\Http\Controllers\User\OrderController::class, 'index'])->name('profile.orders.index');
        Route::get('/order/{order}', [\App\Http\Controllers\User\OrderController::class, 'show'])->name('profile.orders.show');
        Route::get('/order/{order}/payment', [\App\Http\Controllers\User\OrderController::class, 'payment'])->name('orders.payment');
        Route::get('/order/{order}/repeat', [\App\Http\Controllers\User\OrderController::class, 'repeat'])->name('profile.orders.repeat');
        Route::get('/order/{order}/cancel', [\App\Http\Controllers\User\OrderController::class, 'cancel'])->name('profile.orders.cancel');
        Route::get('/subscriptions', [\App\Http\Controllers\ProfileController::class, 'subscriptions'])->name('profile.subscriptions');
        Route::get('/addresses', [\App\Http\Controllers\ProfileController::class, 'addresses'])->name('profile.addresses');
        Route::get('/address', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.addresses.show');
        Route::delete('/addresses', [\App\Http\Controllers\ProfileController::class, 'deleteAddress'])->name('profile.addresses.delete');
        Route::put('/addresses', [\App\Http\Controllers\ProfileController::class, 'updateAddress'])->name('profile.addresses.update');
        Route::get('/payment-methods', [\App\Http\Controllers\ProfileController::class, 'payment_methods'])->name('profile.payment-methods');
        Route::get('/gift-cards', [\App\Http\Controllers\ProfileController::class, 'gift_cards'])->name('profile.gift-cards');
        Route::post('/gift-cards', [\App\Http\Controllers\GiftController::class, 'activate'])->name('profile.gift-cards.activate');
        Route::get('/bonuses', [\App\Http\Controllers\ProfileController::class, 'bonuses'])->name('profile.bonuses');
        Route::get('/password', [\App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
        Route::get('/support', [\App\Http\Controllers\ProfileController::class, 'support'])->name('profile.support');
//        Route::get('/logout', [\App\Http\Controllers\ProfileController::class, 'logout'])->name('profile.logout');
        Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::post('/add-payment-method', [\App\Http\Controllers\ProfileController::class, 'add_payment'])->name('profile.add-payment-method');
        Route::delete('/payment-method', [\App\Http\Controllers\ProfileController::class, 'delete_payment'])->name('profile.payment-method.delete');
        Route::post('/add-address', [\App\Http\Controllers\ProfileController::class, 'add_address'])->name('profile.add-address');
        Route::post('/update-default-address', [\App\Http\Controllers\ProfileController::class, 'update_default_address'])->name('profile.update-default-address');
        Route::post('/reset-password', [\App\Http\Controllers\ProfileController::class, 'reset_password'])->name('profile.reset-password');
    });

    // Cart
    Route::get('cart/delivery', [\App\Http\Controllers\CartController::class, 'delivery'])
        ->middleware('can-checkout')
        ->name('cart.delivery');
    Route::post('cart/delivery', [\App\Http\Controllers\CartController::class, 'deliveryStore'])
        ->middleware('can-checkout')
        ->name('cart.delivery.store');
    Route::get('cart/payment', [\App\Http\Controllers\CartController::class, 'payment'])
        ->middleware('can-checkout')
        ->name('cart.payment');
    Route::post('cart/checkout', [\App\Http\Controllers\CartController::class, 'checkoutStore'])
        ->middleware('can-checkout')
        ->name('cart.checkout.store');
    Route::post('cart/use-bonuses', [\App\Http\Controllers\CartController::class, 'useBonuses'])
        ->middleware('can-checkout')
        ->name('cart.use-bonuses');
    Route::post('cart/use-promo', [\App\Http\Controllers\CartController::class, 'usePromo'])
        ->middleware('can-checkout')
        ->name('cart.use-promo');
    Route::get('cart/success/{order}', [\App\Http\Controllers\CartController::class, 'success'])->name('cart.success');
    Route::get('cart/error', [\App\Http\Controllers\CartController::class, 'error'])->name('cart.error');


    // Gift card
    Route::get('gift-card', [\App\Http\Controllers\GiftController::class, 'index'])->name('gif-card.index');
    Route::get('gift-card/create', [\App\Http\Controllers\GiftController::class, 'create'])->name('gif-card.create');
    Route::post('gift-card', [\App\Http\Controllers\GiftController::class, 'store'])->name('gif-card.store');
    Route::get('gift-card/cart/success', [\App\Http\Controllers\GiftController::class, 'success'])->name('gift-card.cart.success');
    Route::get('gift-card/cart', [\App\Http\Controllers\GiftController::class, 'cart'])->name('gift_card.cart');
    Route::get('gift-card/cart/clear', [\App\Http\Controllers\GiftController::class, 'cartClear'])->name('gift_card.cart.clear');
    Route::post('gift-card/cart/store', [\App\Http\Controllers\GiftController::class, 'cartStore'])->name('gift_card.cart.store');
});
// Cart
Route::get('cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::get('cart/gifts', [\App\Http\Controllers\CartController::class, 'gifts'])->name('cart.gifts');
Route::post('cart', [\App\Http\Controllers\CartController::class, 'indexStore'])
    ->middleware('can-checkout')
    ->name('cart.store');
Route::post('cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/plus-quantity', [\App\Http\Controllers\CartController::class, 'plusQuantity'])->name('cart.plus-quantity');
Route::post('cart/minus-quantity', [\App\Http\Controllers\CartController::class, 'minusQuantity'])->name('cart.minus-quantity');
Route::get('cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
Route::get('cart/login', [\App\Http\Controllers\CartController::class, 'login'])->name('cart.login')->middleware('guest');
Route::post('fast-register', [\App\Http\Controllers\Auth\FastRegisterController::class, 'store'])
    ->name('fast-register')->middleware('guest');

// Admin
Route::get('admin', [AdminController::class, 'index'])->name('admin.home');
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    // Products Info download
    Route::get('product_info/download', [AdminController::class, 'downloadProductJson'])->name('admin.product-info.download');
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
    Route::get('products/variation', [\App\Http\Controllers\Admin\ProductController::class, 'showVariation'])->name('admin.product.variation.show');
    Route::post('products/variation', [\App\Http\Controllers\Admin\ProductController::class, 'storeVariation'])->name('admin.product.variation.store');
    Route::put('products/variation', [\App\Http\Controllers\Admin\ProductController::class, 'updateVariation'])->name('admin.product.variation.update');
//    Product
    Route::get('products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
    Route::post('products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::delete('products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('admin.product.delete');
    Route::get('products/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::get('products/edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::get('products/properties', [\App\Http\Controllers\Admin\ProductController::class, 'getProperties'])->name('admin.product.properties');
    Route::post('products/update/seo', [\App\Http\Controllers\Admin\ProductController::class, 'updateSeo'])->name('admin.product.update.seo');
    Route::post('products/update/micro-seo', [\App\Http\Controllers\Admin\ProductController::class, 'updateMicroSeo'])->name('admin.product.update.micro-seo');
    Route::get('products/search', [\App\Http\Controllers\Admin\ProductController::class, 'searchProducts'])->name('admin.products.search');
    Route::post('products/images-sort', [\App\Http\Controllers\Admin\ProductController::class, 'sortImages'])->name('admin.product_images.sort');

//    Categories
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::post('categories', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('categories/remove/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    Route::put('categories', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::get('categories/search', [AdminCategoryController::class, 'search'])->name('admin.categories.search');
    Route::post('categories/update-position', [AdminCategoryController::class, 'updatePosition'])->name('admin.categories.updatePosition');
    Route::post('_update-properties-position', [AdminCategoryController::class, 'updatePropertiesPosition'])->name('admin.categories.updatePropsPosition');
    Route::post('categories/update/seo', [AdminCategoryController::class, 'updateSeo'])->name('admin.categories.update.seo');
    Route::post('categories/update/micro-seo', [AdminCategoryController::class, 'updateMicroSeo'])->name('admin.categories.update.micro-seo');

    // Article
    Route::get('article/{id}', [\App\Http\Controllers\Admin\ArticleController::class, 'show'])->name('admin.article.show');
    Route::post('article/store', [\App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('admin.article.store');
    Route::put('article/{article}/update', [\App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('admin.article.update');
    Route::post('article/sort', [\App\Http\Controllers\Admin\ArticleController::class, 'sort'])->name('admin.article.sort');
    Route::delete('article/delete', [\App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('admin.article.delete');

    // GIF CARD
    Route::get('gif-card', [\App\Http\Controllers\Admin\GifCardController::class, 'index'])->name('admin.gif-card');
    Route::post('gif-card-min', [\App\Http\Controllers\Admin\GifCardController::class, 'storeMinSum'])->name('admin.storeMinSum');
    Route::post('gif-card-max', [\App\Http\Controllers\Admin\GifCardController::class, 'storeMaxSum'])->name('admin.storeMaxSum');
    Route::post('gif-card-fix-price', [\App\Http\Controllers\Admin\GifCardController::class, 'storeFixPrice'])->name('admin.fixPrice');
    Route::put('gif-card-fix-price-update/{id}', [\App\Http\Controllers\Admin\GifCardController::class, 'updateFixPrice'])->name('admin.updateFixPrice');
    Route::delete('gif-card-fix-price-delete/{id}', [\App\Http\Controllers\Admin\GifCardController::class, 'deleteFixPrice'])->name('admin.deleteFixPrice');
    Route::post('gif-card-color', [\App\Http\Controllers\Admin\GifCardController::class, 'storeColorCard'])->name('admin.storeColorCard');
    Route::delete('gif-card-color-delete/{id}', [\App\Http\Controllers\Admin\GifCardController::class, 'deleteColorCard'])->name('admin.deleteColorCard');

//    Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Delivery methods
    Route::resource('delivery-methods', \App\Http\Controllers\Admin\Settings\DeliveryMethodController::class, [
        'only' => ['index', 'show', 'update', 'destroy'],
        'as' => 'admin',
    ]);
    Route::post('delivery-methods/update-positions', [\App\Http\Controllers\Admin\Settings\DeliveryMethodController::class, 'updatePositions'])
        ->name('admin.delivery-methods.update-positions');
    Route::post('delivery-methods/bulk-change-status', [\App\Http\Controllers\Admin\Settings\DeliveryMethodController::class, 'bulkChangeStatus'])
        ->name('admin.delivery-methods.bulk-change-status');


    Route::group(['middleware' => 'is-super-admin', 'as' => 'admin.'], function () {
        Route::get('settings/socials', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'index'])->name('settings.socials');
        Route::get('settings/social', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'show'])->name('settings.social.show');
        Route::post('settings/social', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'store'])->name('settings.social.store');
        Route::post('settings/social-messenger', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'storeMessenger'])->name('settings.social-messenger.store');
        Route::post('settings/social/update', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'update'])->name('settings.social.update');
        Route::delete('settings/social/drop', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'destroy'])->name('settings.social.destroy');
        Route::post('settings/social/change_status', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'change_status'])->name('settings.social.change_status');
        Route::post('settings/social/update-positions', [\App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'updates_positions'])->name('settings.social.update_positions');
        //    Social media

//     Phone Social Media
        Route::get('settings/phone/edit/', [App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'edit'])->name('settings.phone.edit');
        Route::put('settings/phone/update/', [App\Http\Controllers\Admin\Settings\SocialMediaController::class, 'updatePhone'])->name('settings.phone.update');

        Route::get('clear-cache', [SettingController::class, 'clearCache'])->name('clear.cache');
//    Route::post('logout')->name('logout');


        // Admin Faq group
        Route::get('faq-groups', [\App\Http\Controllers\Admin\FaqGroupController::class, 'index'])->name('faq-groups');
        Route::get('faq-groups/search', [\App\Http\Controllers\Admin\FaqGroupController::class, 'search'])->name('faq-groups.search');
        Route::post('faq-groups/update-positions', [\App\Http\Controllers\Admin\FaqGroupController::class, 'updates_positions'])->name('faq-groups.update_positions');
        Route::get('faq-groups/create', [\App\Http\Controllers\Admin\FaqGroupController::class, 'create'])->name('faq-groups.create');
        Route::get('faq-groups/{id}/edit', [\App\Http\Controllers\Admin\FaqGroupController::class, 'edit'])->name('faq-groups.edit');
        Route::post('faq-groups/store', [\App\Http\Controllers\Admin\FaqGroupController::class, 'store'])->name('faq-groups.store');
        Route::put('faq-groups/update', [\App\Http\Controllers\Admin\FaqGroupController::class, 'update'])->name('faq-groups.update');
        Route::delete('faq-groups/delete', [\App\Http\Controllers\Admin\FaqGroupController::class, 'delete'])->name('faq-groups.delete');
        /* Admin Faq */
        Route::get('faqs', [\App\Http\Controllers\Admin\FaqController::class, 'index'])->name('faqs');
        Route::get('faqs/search', [\App\Http\Controllers\Admin\FaqController::class, 'search'])->name('faqs.search');
        Route::post('faqs/update-positions', [\App\Http\Controllers\Admin\FaqController::class, 'updates_positions'])->name('faqs.update_positions');
        Route::get('faq/show', [\App\Http\Controllers\Admin\FaqController::class, 'show'])->name('faq.show');
        Route::post('faq/store', [\App\Http\Controllers\Admin\FaqController::class, 'store'])->name('faq.store');
        Route::post('faq/update', [\App\Http\Controllers\Admin\FaqController::class, 'update'])->name('faq.update');
        Route::delete('faq/delete', [\App\Http\Controllers\Admin\FaqController::class, 'delete'])->name('faq.delete');
//    Route::post('_active-products', [\App\Http\Controllers\Admin\ProductController::class, 'activeProducts']);


        // Pages
        Route::get('/pages', [\App\Http\Controllers\Admin\PagesController::class, 'index'])->name('pages.index');
        Route::get('/pages/{id}/edit', [\App\Http\Controllers\Admin\PagesController::class, 'edit'])->name('pages.edit');
        Route::post('/pages', [\App\Http\Controllers\Admin\PagesController::class, 'store'])->name('pages.store');
        Route::get('/pages/create', [\App\Http\Controllers\Admin\PagesController::class, 'create'])->name('pages.create');
        Route::put('/pages/update', [\App\Http\Controllers\Admin\PagesController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{id}/delete', [\App\Http\Controllers\Admin\PagesController::class, 'delete'])->name('pages.delete');

        /** Roles */
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)
            ->except(['create', 'edit']);
        /** /Roles */
        /** Admins */
        Route::resource('admins', \App\Http\Controllers\Admin\AdminUserController::class)
            ->except(['create', 'edit']);
        /** /Admins */

        // Order Statuses
        Route::resource('order_statuses', \App\Http\Controllers\Admin\OrderStatusController::class);

        Route::resource('seo-templates', \App\Http\Controllers\Admin\SeoTemplateController::class);

    });

    // Tags
    Route::get('/tag', [\App\Http\Controllers\Admin\TagController::class, 'show'])->name('admin.tag.show');
    Route::post('/tag', [\App\Http\Controllers\Admin\TagController::class, 'store'])->name('admin.tag.store');
    Route::put('/tag', [\App\Http\Controllers\Admin\TagController::class, 'update'])->name('admin.tag.update');
    Route::delete('/tag', [\App\Http\Controllers\Admin\TagController::class, 'delete'])->name('admin.tag.delete');
    Route::post('/tag/update-position', [\App\Http\Controllers\Admin\TagController::class, 'updatePosition'])->name('admin.tag.update_position');

    Route::post('update-price-from-excel', [\App\Http\Controllers\Admin\ProductController::class, 'updatePricesFromExcel'])
        ->name('admin.update-price-from-excel');

//    Images
    Route::get('images/show', [\App\Http\Controllers\Admin\ImageController::class, 'show'])->name('admin.image.show');

    /* Categories Operation */
    Route::post('_delete-categories', [AdminCategoryController::class, 'deleteCategories']);
    Route::post('_active-categories', [AdminCategoryController::class, 'activeCategories']);
    /* Product Operation */
    Route::post('_delete-products', [\App\Http\Controllers\Admin\ProductController::class, 'deleteProducts']);

    // Feedback Chat
    Route::get('chats', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('admin.chats');
    Route::get('chats/{id}/edit', [\App\Http\Controllers\Admin\FeedbackController::class, 'edit'])->name('admin.chats.edit');
    Route::post('chats/update_status', [\App\Http\Controllers\Admin\FeedbackController::class, 'updateStatus'])->name('admin.chats.updateStatus');

    /* News */
    Route::get('newses', [\App\Http\Controllers\Admin\News\NewsController::class, 'index'])->name('admin.news');
    Route::get('news', [\App\Http\Controllers\Admin\News\NewsController::class, 'create'])->name('admin.news.create');
    Route::post('news', [\App\Http\Controllers\Admin\News\NewsController::class, 'store'])->name('admin.news.store');
    Route::get('news/edit/{id}', [\App\Http\Controllers\Admin\News\NewsController::class, 'edit'])->name('admin.news.edit');
    Route::post('news/update', [\App\Http\Controllers\Admin\News\NewsController::class, 'update'])->name('admin.news.update');
    Route::post('news/update/seo', [\App\Http\Controllers\Admin\News\NewsController::class, 'updateSeo'])->name('admin.news.update.seo');
    Route::get('news/delete/{id}', [\App\Http\Controllers\Admin\News\NewsController::class, 'delete'])->name('admin.news.delete');
    Route::post('_active-posts-news', [\App\Http\Controllers\Admin\News\NewsController::class, 'activePosts'])->name('admin.news.active');
    Route::post('news/update/seo', [\App\Http\Controllers\Admin\News\NewsController::class, 'updateSeo'])->name('admin.news.update.seo');
    Route::post('news/update/micro-seo', [\App\Http\Controllers\Admin\News\NewsController::class, 'updateMicroSeo'])->name('admin.news.update.micro-seo');
    Route::post('news/images', [\App\Http\Controllers\Admin\News\NewsImageController::class, 'store'])->name('admin.news.image.store');
    Route::put('news/images/update-positions', [\App\Http\Controllers\Admin\News\NewsImageController::class, 'updateImagesPosition'])->name('admin.news.image.update-position');
    Route::delete('news/images', [\App\Http\Controllers\Admin\News\NewsImageController::class, 'delete'])->name('admin.news.image.delete');


    /* Banners */
    Route::get('banners', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'index'])->name('admin.banner');
    Route::get('banner', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'create'])->name('admin.banner.create');
    Route::post('banner', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'store'])->name('admin.banner.store');
    Route::get('banner/edit/{id}', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::post('banner/update', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'update'])->name('admin.banner.update');
    Route::get('banner/delete/{id}', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'delete'])->name('admin.banner.delete');
    Route::post('banner/update-position', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'updatePosition'])->name('admin.banners.update_positions');
    Route::post('banner/update/seo', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'updateSeo'])->name('admin.banner.update.seo');
    Route::post('banner/update/micro-seo', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'updateMicroSeo'])->name('admin.banner.update.micro-seo');

    // Comments
    Route::get('comments', [\App\Http\Controllers\Admin\CommentsController::class, 'index'])->name('admin.comment');
    Route::get('comment', [\App\Http\Controllers\Admin\CommentsController::class, 'create'])->name('admin.comment.create');
    Route::post('comment', [\App\Http\Controllers\Admin\CommentsController::class, 'store'])->name('admin.comment.store');
    Route::get('comment/edit/{id}', [\App\Http\Controllers\Admin\CommentsController::class, 'edit'])->name('admin.comment.edit');
    Route::post('comment/_update', [\App\Http\Controllers\Admin\CommentsController::class, 'update'])->name('admin.comment.update');
    Route::get('comment/delete/{id}', [\App\Http\Controllers\Admin\CommentsController::class, 'delete'])->name('admin.comment.delete');

    /* Banners Operation */
    Route::post('_active-posts', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'activePosts'])->name('admin.banner.active');

    // Properties
    Route::get('properties', [\App\Http\Controllers\Admin\PropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('properties/create', [\App\Http\Controllers\Admin\PropertyController::class, 'create'])->name('admin.properties.create');
    Route::post('properties', [\App\Http\Controllers\Admin\PropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('properties/{id}/edit', [\App\Http\Controllers\Admin\PropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::put('properties/{id}', [\App\Http\Controllers\Admin\PropertyController::class, 'update'])->name('admin.properties.update');
    Route::delete('properties/{id}', [\App\Http\Controllers\Admin\PropertyController::class, 'delete'])->name('admin.properties.delete');

    // Property Values
    Route::post('property-values/store', [\App\Http\Controllers\Admin\PropertyValueController::class, 'store'])->name('admin.property-values.store');
    Route::post('property-values/update', [\App\Http\Controllers\Admin\PropertyValueController::class, 'update'])->name('admin.property-values.update');
    Route::post('property-values/drop', [\App\Http\Controllers\Admin\PropertyValueController::class, 'drop'])->name('admin.property-values.drop');

    // Brands
    Route::get('/brands', [\App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin.brands.index');
    Route::post('/brands', [\App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brands.store');
    Route::put('/brands/{brand}/update', [\App\Http\Controllers\Admin\BrandController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/delete', [\App\Http\Controllers\Admin\BrandController::class, 'delete'])->name('admin.brands.delete');
    Route::get('/brands/show', [\App\Http\Controllers\Admin\BrandController::class, 'show'])->name('admin.brands.show');
    Route::delete('/brands/{id}/deleteImage', [\App\Http\Controllers\Admin\BrandController::class, 'deleteImage'])->name('admin.brands.deleteImage');
    Route::get(' brands/search', [\App\Http\Controllers\Admin\BrandController::class, 'search'])->name('admin.brands.search');
    Route::get('brands/{brand}/edit', [\App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('admin.brands.edit');

    // Product Property Values
    Route::post('product-property-values/store', [\App\Http\Controllers\Admin\ProductPropertyValueController::class, 'store'])->name('admin.product-property-values.store');


    // Feedback Reasons
    Route::get('/feedback-reasons', [\App\Http\Controllers\Admin\FeedbackReasonController::class, 'index'])->name('admin.feedback-reason.index');
    Route::get('/feedback-reason', [\App\Http\Controllers\Admin\FeedbackReasonController::class, 'show'])->name('admin.feedback-reason.show');
    Route::post('/feedback-reasons', [\App\Http\Controllers\Admin\FeedbackReasonController::class, 'store'])->name('admin.feedback-reason.store');
    Route::put('/feedback-reason', [\App\Http\Controllers\Admin\FeedbackReasonController::class, 'update'])->name('admin.feedback-reason.update');
    Route::delete('/feedback-reason', [\App\Http\Controllers\Admin\FeedbackReasonController::class, 'delete'])->name('admin.feedback-reason.delete');

     /* Users */
     Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
     Route::get('user/show/{id}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user.show');
     Route::get('user/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
     Route::post('user/update', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
     Route::get('user/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user.delete');
     Route::post('user/generate-password', [\App\Http\Controllers\Admin\UserController::class, 'generate_password'])->name('admin.user.generate-password');

    /* Subscribers */
    Route::get('subscribers', [\App\Http\Controllers\Admin\SubscribersController::class, 'index'])->name('admin.subscribers.index');
    Route::get('subscribers/delete/{id}', [\App\Http\Controllers\Admin\SubscribersController::class, 'delete'])->name('admin.subscriber.delete');
    Route::post('subscribers/send-newsletter', [\App\Http\Controllers\Admin\SubscribersController::class, 'send_newsletter'])->name('admin.subscribers.send-newsletter');
    Route::post('subscribers/update-category', [\App\Http\Controllers\Admin\SubscribersController::class, 'update_category'])->name('admin.subscribers.update_category');

    /* Subscription Categories */
    Route::get('subscription-categories', [\App\Http\Controllers\Admin\SubscriptionCategoryController::class, 'index'])->name('admin.subscription-category.index');
    Route::delete('subscription-categories/delete', [\App\Http\Controllers\Admin\SubscriptionCategoryController::class, 'delete'])->name('admin.subscription-category.delete');
    Route::get('subscription-categories/show', [\App\Http\Controllers\Admin\SubscriptionCategoryController::class, 'show'])->name('admin.subscription-category.show');
    Route::post('subscription-categories', [\App\Http\Controllers\Admin\SubscriptionCategoryController::class, 'store'])->name('admin.subscription-category.store');
    Route::put('subscription-categories/update', [\App\Http\Controllers\Admin\SubscriptionCategoryController::class, 'update'])->name('admin.subscription-category.update');
    /* Main Block */
    Route::get('main-blocks', [\App\Http\Controllers\Admin\MainPageBlockController::class, 'index'])->name('admin.main-block.index');
//    Route::get('main-block', [\App\Http\Controllers\Admin\MainPageBlockController::class, 'show'])->name('admin.main-block.show');
    Route::post('main-block/update', [\App\Http\Controllers\Admin\MainPageBlockController::class, 'update'])->name('admin.main-block.update');
    /* Settings */
    Route::get('settings', [\App\Http\Controllers\Admin\SiteConfigController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SiteConfigController::class, 'store'])->name('admin.settings.store');

    // Orders
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class, ['as' => 'admin']);
    Route::put('/orders/{order}/change-status', [\App\Http\Controllers\Admin\OrderController::class, 'changeStatus'])->name('admin.orders.change-status');
    Route::delete('/order-product/destroy/{orderProduct}', [\App\Http\Controllers\Admin\OrderProductController::class, 'destroy'])->name('admin.order_products.destroy');
    Route::post('/order-product/add', [\App\Http\Controllers\Admin\OrderProductController::class, 'add'])->name('admin.order_products.add');
    Route::post('/order-product/refresh', [\App\Http\Controllers\Admin\OrderProductController::class, 'refresh'])->name('admin.order_products.refresh');
    // Order Gifts
    Route::post('/order/gifts/table', [\App\Http\Controllers\Admin\OrderGiftController::class, 'table'])->name('admin.order-gifts.table');

    // Product Questions
    Route::get('product_questions', [\App\Http\Controllers\Admin\ProductQuestionController::class, 'index'])->name('admin.product_questions');
    Route::get('product_questions/{id}', [\App\Http\Controllers\Admin\ProductQuestionController::class, 'view'])->name('admin.product_question.view');
    Route::post('product_questions/answer', [\App\Http\Controllers\Admin\ProductQuestionController::class, 'answer'])->name('admin.product_question.answer');
    Route::put('product_questions/update', [\App\Http\Controllers\Admin\ProductQuestionController::class, 'update'])->name('admin.product_question.update');
    Route::post('product_question/update_status', [\App\Http\Controllers\Admin\ProductQuestionController::class, 'updateStatus'])->name('admin.product_question.update_status');
    Route::post('product_question/update_bulk_status', [\App\Http\Controllers\Admin\ProductQuestionController::class, 'updateBulkStatus'])->name('admin.product_question.update_bulk_status');
    Route::get('product_questions/{id}/delete', [\App\Http\Controllers\Admin\ProductQuestionController::class, 'delete'])->name('admin.product_question.delete');
    // Gift Cards
    Route::resource('gift_cards', \App\Http\Controllers\Admin\GiftCardController::class, ['as' => 'admin']);
    Route::put('gift_card/{gift_card}/deactivate', [\App\Http\Controllers\Admin\GiftCardController::class, 'deactivate'])->name('admin.gift_cards.deactivate');
    Route::get('/user/{email}', [\App\Http\Controllers\Admin\GiftCardController::class, 'showByEmail'])->name('admin.user.showByEmail');

    // Gifts
    Route::get('gifts', [\App\Http\Controllers\Admin\GiftController::class, 'index'])->name('admin.gifts.index');
    // Gifts > Products
    Route::resource('gift_products', \App\Http\Controllers\Admin\GiftProductController::class, ['as' => 'admin']);
    // Gifts > Conditions
    Route::resource('gift_conditions', \App\Http\Controllers\Admin\GiftConditionController::class, ['as' => 'admin']);

    // PromoCodes
    Route::resource('promo_codes', \App\Http\Controllers\Admin\PromoCodeController::class, ['as' => 'admin']);

    /* Banners */
    Route::post('category_post', [\App\Http\Controllers\Admin\CategoryPostsController::class, 'store'])->name('admin.category_post.store');
    Route::get('category_posts/{id}', [\App\Http\Controllers\Admin\CategoryPostsController::class, 'show'])->name('admin.category_post.show');
    Route::put('category_post/update', [\App\Http\Controllers\Admin\CategoryPostsController::class, 'update'])->name('admin.category_post.update');
    Route::delete('category_post/delete', [\App\Http\Controllers\Admin\CategoryPostsController::class, 'delete'])->name('admin.category_post.delete');
    Route::post('category_posts/update-position', [\App\Http\Controllers\Admin\CategoryPostsController::class, 'updatePosition'])->name('admin.category_posts.update_positions');
    Route::post('category_post/update-status', [\App\Http\Controllers\Admin\CategoryPostsController::class, 'updateStatus'])->name('admin.category_posts.update_status');

    /** Category > ProductSort */
    Route::post('category-product-sorts/update-positions', [\App\Http\Controllers\Admin\CategoryProductSortController::class, 'updatePositions'])
        ->name('admin.category-product-sorts.update-positions');
    Route::resource('category-product-sorts', \App\Http\Controllers\Admin\CategoryProductSortController::class, ['as' => 'admin'])
        ->only(['store', 'destroy']);

    /** Courier Delivery Methods */
    Route::resource('courier-delivery-methods', \App\Http\Controllers\Admin\Settings\CourierDeliveryMethodController::class, [
        'as' => 'admin'
    ]);
    Route::get('get-states', [\App\Http\Controllers\Admin\Settings\CourierDeliveryMethodController::class, 'getStates']);
    Route::get('get-cities', [\App\Http\Controllers\Admin\Settings\CourierDeliveryMethodController::class, 'getCities']);
    /** /Courier Delivery Methods */


    /** Product Prices */
    Route::post('product-prices/update-status', [ProductPriceController::class, 'updateStatus'])
        ->name('admin.product-prices.update-status');
    Route::post('product-prices/update-positions', [ProductPriceController::class, 'updatePositions'])
        ->name('admin.product-price.update-positions');
    Route::resource('product-prices', \App\Http\Controllers\Admin\ProductPriceController::class, [
        'as' => 'admin'
    ]);
    /** /Product Prices */

});

// General Pages
Route::get('/news', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{link}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.post');
Route::get('/blog/{link}', [\App\Http\Controllers\BlogController::class, 'show'])->name('index.blog');
Route::get('/banner/{link}', [\App\Http\Controllers\BannerController::class, 'show'])->name('index.banner');
Route::get('/load_questions', [\App\Http\Controllers\ProductQuestionController::class, 'loadQuestions'])->name('product_questions.load');

//Comments
Route::post('/comment', [App\Http\Controllers\CommentsController::class, 'store'])->name('send.comment');
Route::post('/comment/like', [App\Http\Controllers\CommentsController::class, 'like'])->name('send.like');
Route::post('/comment/dislike', [App\Http\Controllers\CommentsController::class, 'dislike'])->name('send.dislike');
Route::get('/load_comments', [App\Http\Controllers\CommentsController::class, 'loadComments'])->name('comment.load');
Route::get('/sort_comments/{alias}', [App\Http\Controllers\CommentsController::class, 'sortComments'])->name('comment.sort');

// Product Availability
Route::resource('product-availability', \App\Http\Controllers\ProductAvailabilityWaiterController::class)
    ->only(['store']);


Route::get('/user/home', [App\Http\Controllers\HomeController::class, 'home'])->name('user.home');

// Subscription
Route::post('/subscribe', [\App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');


/** Delivery Points */
Route::get('delivery-points', [\App\Http\Controllers\DeliveryPointController::class, 'index'])->name('delivery-points.index');

// Front pages - only for admin users
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'front'], function () {
    Route::get('', [\App\Http\Controllers\FrontCardController::class, 'index']);
    Route::get('/{alias}', [\App\Http\Controllers\FrontCardController::class, 'page']);
});
