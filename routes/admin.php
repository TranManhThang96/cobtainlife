<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::domain(config('app.subdomain_admin'))->name('admin.')->group(function () {

    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.get');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index']);
        Route::get('/categories/search', [\App\Http\Controllers\Admin\ShopCategoryController::class, 'search'])->name('categories.search');
        Route::resource('/categories', ShopCategoryController::class);
        Route::get('/products/search', [\App\Http\Controllers\Admin\ShopProductController::class, 'search'])->name('products.search');
        Route::resource('/products', ShopProductController::class);
        Route::get('/orders/search', [\App\Http\Controllers\Admin\ShopOrderController::class, 'search'])->name('orders.search');
        Route::resource('/orders', ShopOrderController::class);
        Route::resource('/provinces', ProvinceController::class);
        Route::resource('/districts', DistrictController::class);
        Route::get('/order-status/search', [\App\Http\Controllers\Admin\ShopOrderStatusController::class, 'search'])->name('order_status.search');
        Route::resource('/order-status', ShopOrderStatusController::class);
        Route::get('/shipping-status/search', [\App\Http\Controllers\Admin\ShopShippingStatusController::class, 'search'])->name('shipping_status.search');
        Route::resource('/shipping-status', ShopShippingStatusController::class);
        Route::get('/payment-status/search', [\App\Http\Controllers\Admin\ShopPaymentStatusController::class, 'search'])->name('payment_status.search');
        Route::resource('/payment-status', ShopPaymentStatusController::class);
        Route::get('/weight-class/search', [\App\Http\Controllers\Admin\ShopWeightClassController::class, 'search'])->name('weight_class.search');
        Route::resource('/weight-class', ShopWeightClassController::class);
        Route::get('/length-class/search', [\App\Http\Controllers\Admin\ShopLengthClassController::class, 'search'])->name('length_class.search');
        Route::resource('/length-class', ShopLengthClassController::class);
        Route::get('/tax/search', [\App\Http\Controllers\Admin\ShopTaxController::class, 'search'])->name('tax.search');
        Route::resource('/tax', ShopTaxController::class);
    });
});


