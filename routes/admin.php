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
        Route::get('/chart', [\App\Http\Controllers\Admin\HomeController::class, 'chart']);
        Route::get('/categories/search', [\App\Http\Controllers\Admin\ShopCategoryController::class, 'search'])->name('categories.search');
        Route::resource('/categories', \ShopCategoryController::class);
        Route::get('/products/search', [\App\Http\Controllers\Admin\ShopProductController::class, 'search'])->name('products.search');
        Route::resource('/products', \ShopProductController::class);
        Route::get('/orders/search', [\App\Http\Controllers\Admin\ShopOrderController::class, 'search'])->name('orders.search');
        Route::resource('/orders', \ShopOrderController::class);
        Route::resource('/provinces', \ProvinceController::class);
        Route::resource('/districts', \DistrictController::class);
        Route::get('/order-status/search', [\App\Http\Controllers\Admin\ShopOrderStatusController::class, 'search'])->name('order_status.search');
        Route::resource('/order-status', \ShopOrderStatusController::class);
        Route::get('/shipping-status/search', [\App\Http\Controllers\Admin\ShopShippingStatusController::class, 'search'])->name('shipping_status.search');
        Route::resource('/shipping-status', \ShopShippingStatusController::class);
        Route::get('/payment-status/search', [\App\Http\Controllers\Admin\ShopPaymentStatusController::class, 'search'])->name('payment_status.search');
        Route::resource('/payment-status', \ShopPaymentStatusController::class);
        Route::get('/weight-class/search', [\App\Http\Controllers\Admin\ShopWeightClassController::class, 'search'])->name('weight_class.search');
        Route::resource('/weight-class', \ShopWeightClassController::class);
        Route::get('/length-class/search', [\App\Http\Controllers\Admin\ShopLengthClassController::class, 'search'])->name('length_class.search');
        Route::resource('/length-class', \ShopLengthClassController::class);
        Route::get('/tax/search', [\App\Http\Controllers\Admin\ShopTaxController::class, 'search'])->name('tax.search');
        Route::resource('/tax', \ShopTaxController::class);
        Route::get('/attribute-group/search', [\App\Http\Controllers\Admin\ShopAttributeGroupController::class, 'search'])->name('group_attribute.search');
        Route::resource('/attribute-group', \ShopAttributeGroupController::class);
        Route::get('/banners/search', [\App\Http\Controllers\Admin\ShopBannerController::class, 'search'])->name('banners.search');
        Route::resource('/banners', \ShopBannerController::class);
        Route::get('/suppliers/search', [\App\Http\Controllers\Admin\ShopSupplierController::class, 'search'])->name('suppliers.search');
        Route::resource('/suppliers', \ShopSupplierController::class);
        Route::get('/brands/search', [\App\Http\Controllers\Admin\ShopBrandController::class, 'search'])->name('brands.search');
        Route::resource('/brands', \ShopBrandController::class);
        Route::get('/customers/search', [\App\Http\Controllers\Admin\ShopCustomerController::class, 'search'])->name('customers.search');
        Route::resource('/customers', \ShopCustomerController::class);
        Route::get('/news/search', [\App\Http\Controllers\Admin\NewsController::class, 'search'])->name('news.search');
        Route::resource('/news', \NewsController::class);
        Route::resource('/configs', \ShopConfigController::class);
        Route::get('/coupons/search', [\App\Http\Controllers\Admin\ShopCouponController::class, 'search'])->name('coupons.search');
        Route::resource('/coupons', \ShopCouponController::class);
        Route::get('/subscribes/search', [\App\Http\Controllers\Admin\ShopCustomerSubscribe::class, 'search'])->name('subscribes.search');
        Route::post('/custom-subscribes-status', [\App\Http\Controllers\Admin\ShopCustomerSubscribe::class, 'status'])->name('subscribes.status');
        Route::resource('/subscribes', \ShopCustomerSubscribe::class);
        Route::resource('/campaigns', \MailCampaignController::class);
        Route::get('/comments/search', [\App\Http\Controllers\Admin\CommentController::class, 'search'])->name('comments.search');
        Route::post('/comments/reply', [\App\Http\Controllers\Admin\CommentController::class, 'reply'])->name('comments.reply');
        Route::resource('/comments', CommentController::class);
    });
});


