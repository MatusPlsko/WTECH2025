<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        $products = Product::latest()->take(8)->get();
        $categories = Category::all();

        return view('index', compact('products', 'categories'));
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
        $product->load(['images', 'reviews.user']);

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
        $products = Product::where('sale', true)->get();
        return view('sale', compact('products'));
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
