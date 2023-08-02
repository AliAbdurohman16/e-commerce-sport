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

Route::middleware(['role:user'])->group(function () {
    Route::get('carts', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('carts.index');
    Route::post('carts', [App\Http\Controllers\Frontend\CartController::class, 'store'])->name('carts.store');
    Route::delete('carts/{id}', [App\Http\Controllers\Frontend\CartController::class, 'destroy'])->name('carts.destroy');
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('payment/{id}', [App\Http\Controllers\Frontend\CheckoutController::class, 'payment'])->name('payment');
    Route::put('pay/{id}', [App\Http\Controllers\Frontend\CheckoutController::class, 'pay'])->name('pay');
    Route::put('pay-cancel/{id}', [App\Http\Controllers\Frontend\CheckoutController::class, 'payCancel'])->name('pay-cancel');
    Route::get('history', [App\Http\Controllers\Frontend\HistoryController::class, 'index'])->name('history.index');
    Route::get('payment-history', [App\Http\Controllers\Frontend\HistoryController::class, 'paymentHistory'])->name('payment-history');
    Route::post('received', [App\Http\Controllers\Frontend\HistoryController::class, 'received'])->name('received');
    Route::post('review', [App\Http\Controllers\Frontend\HistoryController::class, 'review'])->name('review');
    Route::resources([
        'account' => App\Http\Controllers\Frontend\ProfileController::class,
        'changepassword' => App\Http\Controllers\Frontend\ChangePasswordController::class,
    ]);
    Route::post('send', [App\Http\Controllers\Frontend\ChatController::class, 'send'])->name('send');
    Route::post('delete-all', [App\Http\Controllers\Frontend\ChatController::class, 'deleteAll'])->name('delete-all');
});

Route::middleware('role:admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::get('get-revenue-by-month/{year}', [App\Http\Controllers\Backend\DashboardController::class, 'getRevenueByMonth'])->name('get-revenue-by-month');
    Route::resources([
        'categories' => App\Http\Controllers\Backend\CategoryController::class,
        'products' => App\Http\Controllers\Backend\ProductController::class,
        'discounts-all-product' => App\Http\Controllers\Backend\DiscountAllProductController::class,
        'discounts-lowest-product' => App\Http\Controllers\Backend\DiscountLowestProductController::class,
        'customers' => App\Http\Controllers\Backend\CustomerController::class,
        'profile' => App\Http\Controllers\Backend\ProfileController::class,
        'change-password' => App\Http\Controllers\Backend\ChangePasswordController::class,
        'setting' => App\Http\Controllers\Backend\SettingController::class,
        'sales' => App\Http\Controllers\Backend\SaleController::class,
    ]);
    Route::get('orders/processed', [App\Http\Controllers\Backend\OrderController::class, 'index'])->name('orders.processed');
    Route::post('orders/processed', [App\Http\Controllers\Backend\OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/sent', [App\Http\Controllers\Backend\OrderController::class, 'sent'])->name('orders.sent');
    Route::get('orders/received', [App\Http\Controllers\Backend\OrderController::class, 'received'])->name('orders.received');
    Route::get('orders/rejected', [App\Http\Controllers\Backend\OrderController::class, 'rejected'])->name('orders.rejected');
    Route::get('orders/invoice/{order_id}', [App\Http\Controllers\Backend\OrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('transactions', [App\Http\Controllers\Backend\TransactionController::class, 'index'])->name('transactions.index');
    Route::post('validate', [App\Http\Controllers\Backend\TransactionController::class, 'validationTrans'])->name('transactions.validate');
    Route::post('rejected', [App\Http\Controllers\Backend\TransactionController::class, 'rejected'])->name('transactions.rejected');
    Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/data', [App\Http\Controllers\Backend\ReportController::class, 'data'])->name('reports.data');
    Route::get('chats', [App\Http\Controllers\Backend\ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/person/{id}', [App\Http\Controllers\Backend\ChatController::class, 'person'])->name('chats.person');
    Route::post('chats/send', [App\Http\Controllers\Backend\ChatController::class, 'send'])->name('chats.send');
    Route::post('chats/delete-all', [App\Http\Controllers\Backend\ChatController::class, 'deleteAll'])->name('chats.delete-all');
});

