<?php

use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\CustomLoginController;

Route::post('/login', [CustomLoginController::class, 'login'])->name('login');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/product', [PageController::class, 'oneproduct'])->name('product');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('/sale', [PageController::class, 'sale'])->name('sale');
Route::get('/cart', [PageController::class, 'shopping_cart'])->name('cart');
Route::post('/register', [CustomRegisterController::class, 'registerEnter'])->name('register.custom');
Route::get('/register-success', [PageController::class, 'registersuccess'])->name('registersuccess');
Route::prefix('admin')
    ->name('admin.')
    ->group(function(){
        // 1) Menu – prvé čo vidíš na /admin/products
        Route::get('products', [ProductController::class,'menu'])
            ->name('products.index');

        // 2) Skutočný zoznam + edit stránky
        Route::get('products/manage', [ProductController::class,'list'])
            ->name('products.manage');

        // 3) Všetky ostatné resource routy
        Route::get('products/create',         [ProductController::class,'create'])->name('products.create');
        Route::post('products',               [ProductController::class,'store'])->name('products.store');
        Route::get('products/{product}/edit', [ProductController::class,'edit'])->name('products.edit');
        Route::put('products/{product}',      [ProductController::class,'update'])->name('products.update');
        Route::delete('products/{product}',   [ProductController::class,'destroy'])->name('products.destroy');
    });
