<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('/');
Route::get('products/all', [App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('products.all');
Route::get('products/discount', [App\Http\Controllers\Frontend\ProductController::class, 'discount'])->name('products.discount');
Route::get('products/search', [App\Http\Controllers\Frontend\ProductController::class, 'search'])->name('products.search');
Route::get('products/detail/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('products.detail');
Route::post('products/addToCart/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'addToCart'])->name('products.addToCart');
Route::get('carts', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('carts.index');

Auth::routes();

Route::middleware('role:admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'categories' => App\Http\Controllers\Backend\CategoryController::class,
        'products' => App\Http\Controllers\Backend\ProductController::class,
        'discounts' => App\Http\Controllers\Backend\DiscountController::class,
        'customers' => App\Http\Controllers\Backend\CustomerController::class,
        'profile' => App\Http\Controllers\Backend\ProfileController::class,
        'change-password' => App\Http\Controllers\Backend\ChangePasswordController::class,
        'setting' => App\Http\Controllers\Backend\DiscountController::class,
    ]);
});

