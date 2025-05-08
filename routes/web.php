<?php
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomRegisterController;


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



