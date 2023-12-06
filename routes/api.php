<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('webhook/paykeeper', [\App\Http\Controllers\Webhook\PaykeeperController::class, 'index'])
    ->middleware('paykeeper');


Route::group(['middleware' => 'api'], function () {
    /** Products */
    Route::post('products/import', [\App\Http\Controllers\Api\ProductController::class, 'import']);
    Route::post('products/update-stocks', [\App\Http\Controllers\Api\ProductController::class, 'updateStocks']);

    /** Orders */
    Route::post('orders/export', [\App\Http\Controllers\Api\OrderController::class, 'export']);;
    Route::post('orders/{order}/change-status', [\App\Http\Controllers\Api\OrderController::class, 'changeStatus']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
