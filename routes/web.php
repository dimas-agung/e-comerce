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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(App\Http\Controllers\ProductCategoryController::class)->group(function () {
    Route::get('/product_category', 'index')->name('product_category.index');
    Route::get('/product_category/create', 'create')->name('product_category.create');
    Route::post('/product_category', 'store')->name('product_category.store');
    Route::get('/product_category/{product_category}', 'show')->name('product_category.show');
    Route::get('/product_category/{product_category}/edit', 'edit')->name('product_category.edit');
    Route::put('/product_category/{product_category}', 'update')->name('product_category.update');
    Route::delete('/product_category/{product_category}', 'destroy')->name('product_category.destroy');
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
Route::controller(App\Http\Controllers\AddressController::class)->group(function () {
    Route::get('/address', 'index')->name('address.index');
    Route::get('/address/create', 'create')->name('address.create');
    Route::post('/address', 'store')->name('address.store');
    Route::get('/address/{address}', 'show')->name('address.show');
    Route::get('/address/{address}/edit', 'edit')->name('address.edit');
    Route::put('/address/{address}', 'update')->name('address.update');
    Route::delete('/address/{address}', 'destroy')->name('address.destroy');
});