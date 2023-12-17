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
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user', 'store')->name('user.store');
    Route::get('/user/{user}', 'show')->name('user.show');
    Route::get('/user/{user}/edit', 'edit')->name('user.edit');
    Route::put('/user/{user}', 'update')->name('user.update');
    Route::delete('/user/{user}', 'destroy')->name('user.destroy');
    Route::post('/user/{user}/activated', 'activated')->name('user.activated');
    Route::post('/user/{user}/nonactive', 'nonactive')->name('user.nonactive');
});
Route::controller(App\Http\Controllers\ProductCategoryController::class)->group(function () {
    Route::get('/product_category', 'index')->name('product_category.index');
    Route::get('/product_category/create', 'create')->name('product_category.create');
    Route::post('/product_category', 'store')->name('product_category.store');
    Route::get('/product_category/{product_category}', 'show')->name('product_category.show');
    Route::get('/product_category/{product_category}/edit', 'edit')->name('product_category.edit');
    Route::put('/product_category/{product_category}', 'update')->name('product_category.update');
    Route::delete('/product_category/{product_category}', 'destroy')->name('product_category.destroy');
});
Route::controller(App\Http\Controllers\ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('product.index');
    Route::get('/product/create', 'create')->name('product.create');
    Route::post('/product', 'store')->name('product.store');
    Route::get('/product/{product}', 'show')->name('product.show');
    Route::get('/product/{product}/edit', 'edit')->name('product.edit');
    Route::put('/product/{product}', 'update')->name('product.update');
    Route::delete('/product/{product}', 'destroy')->name('product.destroy');
    Route::post('/product/{address}/activated', 'activated')->name('product.activated');
    Route::post('/product/{address}/nonactive', 'nonactive')->name('product.nonactive');
});
Route::controller(App\Http\Controllers\ProductVarianController::class)->group(function () {
    Route::get('/product_varian', 'index')->name('product_varian.index');
    Route::get('/product_varian/create', 'create')->name('product_varian.create');
    Route::post('/product_varian', 'store')->name('product_varian.store');
    Route::get('/product_varian/{product_varian}', 'show')->name('product_varian.show');
    Route::get('/product_varian/{product_varian}/edit', 'edit')->name('product_varian.edit');
    Route::put('/product_varian/{product_varian}', 'update')->name('product_varian.update');
    Route::post('/product_varian/update_batch', 'update_batch')->name('product_varian.update_batch');
    Route::delete('/product_varian/{product_varian}', 'destroy')->name('product_varian.destroy');
    Route::post('/product_varian/{product_varian}/activated', 'activated')->name('product_varian.activated');
    Route::post('/product_varian/{product_varian}/nonactive', 'nonactive')->name('product_varian.nonactive');
    // Route::get('/product_varian/getData', 'getData')->name('product_varian.getData');
});
Route::controller(App\Http\Controllers\ExpeditionController::class)->group(function () {
    Route::get('/expedition', 'index')->name('expedition.index');
    Route::get('/expedition/create', 'create')->name('expedition.create');
    Route::post('/expedition', 'store')->name('expedition.store');
    Route::get('/expedition/{expedition}', 'show')->name('expedition.show');
    Route::get('/expedition/{expedition}/edit', 'edit')->name('expedition.edit');
    Route::put('/expedition/{expedition}', 'update')->name('expedition.update');
    Route::delete('/expedition/{expedition}', 'destroy')->name('expedition.destroy');
});
Route::controller(App\Http\Controllers\DiscountController::class)->group(function () {
    Route::get('/discount', 'index')->name('discount.index');
    Route::get('/discount/create', 'create')->name('discount.create');
    Route::post('/discount', 'store')->name('discount.store');
    Route::get('/discount/{discount}', 'show')->name('discount.show');
    Route::get('/discount/{discount}/edit', 'edit')->name('discount.edit');
    Route::put('/discount/{discount}', 'update')->name('discount.update');
    Route::delete('/discount/{discount}', 'destroy')->name('discount.destroy');
});
Route::controller(App\Http\Controllers\AddressController::class)->group(function () {
    Route::get('/address', 'index')->name('address.index');
    Route::get('/address/create', 'create')->name('address.create');
    Route::post('/address', 'store')->name('address.store');
    Route::get('/address/{address}', 'show')->name('address.show');
    Route::get('/address/{address}/edit', 'edit')->name('address.edit');
    Route::put('/address/{address}', 'update')->name('address.update');
    Route::delete('/address/{address}', 'destroy')->name('address.destroy');
    Route::post('/address/{address}/activated', 'activated')->name('address.activated');
    Route::post('/address/{address}/nonactive', 'nonactive')->name('address.nonactive');
});
Route::controller(App\Http\Controllers\OrderController::class)->group(function () {
    Route::get('/order', 'index')->name('order.index');
    Route::get('/order/create', 'create')->name('order.create');
    Route::post('/order', 'store')->name('order.store');
    Route::get('/order/{order}', 'show')->name('order.show');
    Route::get('/order/{address}/edit', 'edit')->name('order.edit');
    Route::put('/order/{order}', 'update')->name('order.update');
    Route::post('/order/{order}/cancel', 'cancel')->name('order.cancel');
    Route::post('/order/{order}/activated', 'activated')->name('order.activated');
    Route::post('/order/{order}/nonactive', 'nonactive')->name('order.nonactive');
});

Route::controller(App\Http\Controllers\CarouselController::class)->group(function () {
    Route::get('/carousel', 'index')->name('carousel.index');
    Route::get('/carousel/create', 'create')->name('carousel.create');
    Route::post('/carousel', 'store')->name('carousel.store');
    Route::get('/carousel/{carousel}', 'show')->name('carousel.show');
    Route::get('/carousel/{carousel}/edit', 'edit')->name('carousel.edit');
    Route::put('/carousel', 'update')->name('carousel.update');
    Route::delete('/carousel/{carousel}', 'destroy')->name('carousel.destroy');
    Route::post('/carousel/{carousel}/activated', 'activated')->name('carousel.activated');
    Route::post('/carousel/{carousel}/nonactive', 'nonactive')->name('carousel.nonactive');
});

Route::controller(App\Http\Controllers\LandingPageController::class)->group(function () {
    Route::get('/landing_page', 'index')->name('landing_page.index');
});

Route::controller(App\Http\Controllers\ProductBestSellerController::class)->group(function () {
    Route::get('/product_best_seller', 'index')->name('product_best_seller.index');
    Route::put('/product_best_seller', 'update')->name('product_best_seller.update');
});