<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->input('action') === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->input('action') === 'decrease') {
                $cart[$id]['quantity'] = max(1, $cart[$id]['quantity'] - 1);
            } else {
                $cart[$id]['quantity'] = max(1, (int)$request->input('quantity'));
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']+= $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' =>$product->images->first()?->path
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
