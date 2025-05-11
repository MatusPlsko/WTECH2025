<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
        $quantity = $request->input('quantity', 1);

        if (auth()->check()) {
            // Používateľ je prihlásený, ukladáme do databázy
            $cartItem = CartItem::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }

        } else {
            // Používateľ nie je prihlásený, ukladáme do session
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image' => $product->images->first()?->path
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function checkout(Request $request)
    {
        $user = Auth::user();
        $total = 0;
        $cart = session('cart', []);


        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }


        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending', // Alebo iný stav
            'shipping_address' => json_encode($request->shipping_address), // Predpokladám, že máš pole 'shipping_address'
        ]);


        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price_of_items' => $item['price'],
            ]);
        }


        session()->forget('cart');


        return redirect()->route('ordersuccess', ['order' => $order->id]);
    }
}
