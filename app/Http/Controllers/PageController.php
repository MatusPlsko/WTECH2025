<?php

namespace App\Http\Controllers;

use App\Models\Product;

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
    public function oneproduct()
    {
        return view('oneproduct');
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
        return view('shopping_cart');
    }


    public function registersuccess()
    {
        return view('registersuccess');
    }










}
