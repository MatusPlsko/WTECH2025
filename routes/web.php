<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\CustomLoginController;
use Illuminate\Http\Request;
use App\Models\Product;



Route::middleware(['auth'])->group(function () {
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
});
Route::post('/login', [CustomLoginController::class, 'login'])->name('login');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/order-success/{order}', [PageController::class, 'ordersuccess'])->name('ordersuccess');
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/product/{product}', [PageController::class, 'showProduct'])->name('showProduct');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('/sale', [PageController::class, 'sale'])->name('sale');
Route::get('/cart', [PageController::class, 'shopping_cart'])->name('cart');
Route::post('/register', [CustomRegisterController::class, 'registerEnter'])->name('register.custom');
Route::get('/register-success', [PageController::class, 'registersuccess'])->name('registersuccess');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
Route::get('/products/category/{category}', [ProductController::class, 'filter'])
    ->name('products.filter');

Route::prefix('admin')
    ->name('admin.')
    ->group(function(){

        Route::get('products', [ProductController::class,'menu'])
            ->name('products.index');


        Route::get('products/manage', [ProductController::class,'list'])
            ->name('products.manage');


        Route::get('products/create',         [ProductController::class,'create'])->name('products.create');
        Route::post('products',               [ProductController::class,'store'])->name('products.store');
        Route::get('products/{product}/edit', [ProductController::class,'edit'])->name('products.edit');
        Route::put('products/{product}',      [ProductController::class,'update'])->name('products.update');
        Route::delete('products/{product}',   [ProductController::class,'destroy'])->name('products.destroy');
    });

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
