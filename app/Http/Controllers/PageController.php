<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
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
        $product->load(['images', 'reviews.user', 'category']);


        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('oneproduct', compact('product', 'similarProducts'));
    }

    public function products()
    {
        $products = Product::with('images')->paginate(12);
        return view('products', compact('products'));
    }

    public function ordersuccess($order)
    {
        $order = Order::findOrFail($order);
        return view('ordersuccess', compact('order'));
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
