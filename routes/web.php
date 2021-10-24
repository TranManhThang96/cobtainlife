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

Route::domain(config('app.main_domain'))->name('web.')->group(function () {
    Route::get('', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
    Route::get('/contact-us.html', [\App\Http\Controllers\Web\ContactUsController::class, 'index'])->name('contact-us');
    Route::get('/about-us.html', [\App\Http\Controllers\Web\AboutUsController::class, 'index'])->name('about-us');
    Route::get('/cart-page.html', [\App\Http\Controllers\Web\CartController::class, 'index'])->name('cart');
    Route::resource('/cart', CartController::class);
    Route::get('/blog.html', [\App\Http\Controllers\Web\BlogController::class, 'index'])->name('blog.index');
    Route::resource('/blog', BlogController::class);
    Route::get('/products.html', [\App\Http\Controllers\Web\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/search',[\App\Http\Controllers\Web\ProductController::class, 'search'])->name('products.search');
    Route::resource('/products', ProductController::class);
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'admin.auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

