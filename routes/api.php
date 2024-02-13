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
Route::get('/product_varian_by_detail', [App\Http\Controllers\API\ProductVarianController::class, 'productVarianByDetail'])->name('api.product_varian_by_detail');
Route::get('/cart', [App\Http\Controllers\API\CartController::class, 'index'])->name('api.cart');
Route::post('/cart', [App\Http\Controllers\API\CartController::class, 'store'])->name('api.cart.store');
Route::post('/cart/update', [App\Http\Controllers\API\CartController::class, 'update'])->name('api.cart.update');
Route::delete('/cart/{cart}', [App\Http\Controllers\API\CartController::class, 'destroy'])->name('api.cart.destroy');
Route::post('/order', [App\Http\Controllers\API\OrderController::class, 'store'])->name('api.order.store');
Route::post('/payment', [App\Http\Controllers\API\PaymentController::class, 'store'])->name('api.payment.store');

Route::get('/address', [App\Http\Controllers\API\AddressController::class, 'index'])->name('api.address');
Route::get('/address/district', [App\Http\Controllers\API\AddressController::class, 'getDistricts'])->name('api.address.district');
Route::post('/address', [App\Http\Controllers\API\AddressController::class, 'store'])->name('api.address.store');
Route::put('/address/{address}', [App\Http\Controllers\API\AddressController::class, 'update'])->name('api.address.update');
Route::delete('/address/{address}', [App\Http\Controllers\API\AddressController::class, 'destroy'])->name('api.address.destroy');

Route::get('/user', [App\Http\Controllers\API\UserController::class, 'index'])->name('api.user');
Route::post('/user', [App\Http\Controllers\API\UserController::class, 'store'])->name('api.user.store');
Route::put('/user/{user}', [App\Http\Controllers\API\UserController::class, 'update'])->name('api.user.update');
Route::post('/user/change_password', [App\Http\Controllers\API\UserController::class, 'change_password'])->name('api.user.change_password');
Route::post('login', [AuthController::class, 'login']);
