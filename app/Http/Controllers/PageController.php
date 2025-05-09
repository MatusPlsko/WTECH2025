<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        return view('index');
    }
    public function about()
    {
        return view('about');
    }
    public function news()
    {
        return view('news');
    }
    public function showProduct(Product $product)
    {
        $product->load('images');
        return view('oneproduct', compact('product'));
    }
    public function products()
    {
        $products = Product::with('images')->paginate(12);
        return view('products', compact('products'));
    }
    public function register()
    {
        return view('register');
    }
    public function sale()
    {
        return view('sale');
    }

    public function shopping_cart()
    {
        $cart = session()->get('cart', []);
        $user = Auth::user(); // môže byť aj request()->user()

        return view('shopping_cart', compact('cart', 'user'));
    }



    public function registersuccess()
    {
        return view('registersuccess');
    }










}
