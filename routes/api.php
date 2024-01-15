<?php

use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/product', [App\Http\Controllers\API\ProductController::class, 'index'])->name('api.product');
Route::get('/landing_page/product_best_seller', [App\Http\Controllers\API\LandingPageController::class, 'productBestSeller'])->name('api.landing_page.product_best_seller');
Route::get('/landing_page/carousel', [App\Http\Controllers\API\LandingPageController::class, 'carousel'])->name('api.landing_page.carousel');
Route::get('/landing_page/series', [App\Http\Controllers\API\LandingPageController::class, 'series'])->name('api.landing_page.series');
Route::get('/product/search', [App\Http\Controllers\API\ProductController::class, 'search']);
Route::get('/product_category', [App\Http\Controllers\API\ProductCategoryController::class, 'index'])->name('api.product_category');
Route::get('/product_varian', [App\Http\Controllers\API\ProductVarianController::class, 'index'])->name('api.product_varian');
Route::post('/order', [App\Http\Controllers\API\OrderController::class, 'store'])->name('api.order.store');
Route::post('/payment', [App\Http\Controllers\API\PaymentController::class, 'store'])->name('api.payment.store');

Route::post('login', [AuthController::class, 'login']);
