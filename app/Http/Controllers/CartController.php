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
        $quantity = max(1, (int)$request->input('quantity'));
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('cart')->with('error', 'Product not found');
        }

        if ($quantity > $product->stock_quantity) {
            return redirect()->route('cart')->with('error', 'Not enough stock available');
        }
        if (auth()->check()) {
            $cartItem = CartItem::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart')->with('success', 'Cart updated');
    }

    public function remove($id)
    {
        if (auth()->check()) {
            CartItem::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
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

        // Získaj položky z databázy ak je používateľ prihlásený, inak zo session
        if ($user) {
            $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

            $cart = [];
            foreach ($cartItems as $item) {
                $cart[] = [
                    'id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'image' => $item->product->images->first()?->path,
                ];
            }
        } else {
            $cart = session('cart', []);
        }

        // Výpočet ceny
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }


        $shipping = count($cart) === 0 ? 0 : 4.40;
        $finalTotal = $total + $shipping;


        $order = Order::create([
            'user_id' => $user?->id,
            'total_price' => $finalTotal,
            'status' => 'pending',
            'payment_method' => $request->payment_method ?? 'unknown',
            'shipping_address' => json_encode([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]),
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price_of_items' => $item['price'],
            ]);
        }

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                $product->stock_quantity = max(0, $product->stock_quantity - $item['quantity']);
                $product->save();
            }
        }

        // Vymazanie košíka
        if ($user) {
            CartItem::where('user_id', $user->id)->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('ordersuccess', ['order' => $order->id]);
    }


}
