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
Route::get('categories/{slug}', [App\Http\Controllers\Frontend\CategoryController::class, 'index'])->name('categories.all');

Auth::routes();

Route::middleware('role:user')->group(function () {
    Route::get('carts', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('carts.index');
    Route::post('carts', [App\Http\Controllers\Frontend\CartController::class, 'store'])->name('carts.store');
    Route::delete('carts/{id}', [App\Http\Controllers\Frontend\CartController::class, 'destroy'])->name('carts.destroy');
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('payment', [App\Http\Controllers\Frontend\CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::get('history', [App\Http\Controllers\Frontend\HistoryController::class, 'index'])->name('history.index');
    Route::get('not-yet-paid', [App\Http\Controllers\Frontend\HistoryController::class, 'notYetPaid'])->name('history.not-yet-paid');
    Route::resources([
        'account' => App\Http\Controllers\Frontend\ProfileController::class,
        'changepassword' => App\Http\Controllers\Frontend\ChangePasswordController::class,
    ]);
});

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
    Route::get('orders/processed', [App\Http\Controllers\Backend\OrderController::class, 'index'])->name('orders.processed');
    Route::post('orders/processed', [App\Http\Controllers\Backend\OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/sent', [App\Http\Controllers\Backend\OrderController::class, 'sent'])->name('orders.sent');
    Route::get('orders/received', [App\Http\Controllers\Backend\OrderController::class, 'received'])->name('orders.received');
});

