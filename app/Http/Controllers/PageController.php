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
        $user = Auth::user();

        if ($user) {
            $cartItems = \App\Models\CartItem::with('product.images')
                ->where('user_id', $user->id)
                ->get();

            $cart = [];

            foreach ($cartItems as $item) {
                $product = $item->product;
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item->quantity,
                    'image' => $product->images->first()?->path,
                ];
            }
        } else {
            $cart = session()->get('cart', []);
        }

        return view('shopping_cart', compact('cart', 'user'));
    }



    public function registersuccess()
    {
        return view('registersuccess');
    }










}
