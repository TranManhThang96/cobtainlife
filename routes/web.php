<?php

use App\Http\Controllers\Web\ShopCustomerSubscribe;
use App\Http\Controllers\Web\WishlistController;
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

Route::domain(config('app.main_domain'))->name('web.')->group(function () {
    Route::get('', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
    Route::get('/contact-us.html', [\App\Http\Controllers\Web\ContactUsController::class, 'index'])->name('contact-us');
    Route::get('/about-us.html', [\App\Http\Controllers\Web\AboutUsController::class, 'index'])->name('about-us');
    Route::get('/cart-page.html', [\App\Http\Controllers\Web\CartController::class, 'index'])->name('cart');
    Route::resource('/cart', CartController::class);
    Route::get('/checkout-confirm', [\App\Http\Controllers\Web\CheckoutController::class, 'checkoutConfirm'])->name('checkout-confirm');
    Route::post('/add-order', [\App\Http\Controllers\Web\CheckoutController::class, 'addOrder'])->name('add-order');
    Route::resource('/checkout', CheckoutController::class);
    Route::get('/blog/{type}/{value}', [\App\Http\Controllers\Web\BlogController::class, 'getNewsByType'])->name('blog.type');
    Route::resource('/blog', BlogController::class);
    Route::get('/wishlist', [\App\Http\Controllers\Web\WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist', [\App\Http\Controllers\Web\WishlistController::class, 'render'])->name('wishlist.render');
    Route::get('/compare', [\App\Http\Controllers\Web\CompareController::class, 'index'])->name('compare');
    Route::post('/compare', [\App\Http\Controllers\Web\CompareController::class, 'render'])->name('compare.render');
    Route::get('/products.html', [\App\Http\Controllers\Web\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/search',[\App\Http\Controllers\Web\ProductController::class, 'search'])->name('products.search');
    Route::resource('/products', ProductController::class);
    Route::get('/address/provinces/{id}', [\App\Http\Controllers\Web\AddressController::class, 'province'])->name('address.province');
    Route::get('/address/districts/{id}', [\App\Http\Controllers\Web\AddressController::class, 'district'])->name('address.district');
    Route::resource('/comments', CommentController::class);
    Route::resource('/custom-subscribes', \ShopCustomerSubscribe::class);
    Route::post('/coupons/check', [\App\Http\Controllers\Web\ShopCouponController::class, 'checkCoupon']);
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'admin.auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

