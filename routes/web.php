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
Route::get('products/search', [App\Http\Controllers\Frontend\ProductController::class, 'search'])->name('products.search');
Route::get('products/detail/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('products.detail');
Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart.index');
Route::post('cart/addToCart/{id}', [App\Http\Controllers\Frontend\CartController::class, 'addToCart'])->name('cart.addToCart');

Auth::routes();

Route::middleware(['auth', 'role:admin'])->group(function () {
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

