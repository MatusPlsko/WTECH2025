<?php

namespace App\Http\Controllers;

// App\Http\Controllers\ReviewController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        if (!Auth::check()) {
            return back()->withErrors(['login' => 'You must be logged in.']);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Vytvorenie novej recenzie
        Review::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);


        $product = \App\Models\Product::find($productId);
        if ($product) {
            $average = $product->reviews()->avg('rating');
            $product->rating = $average;
            $product->save();
        }

        return back()->with('success', 'Review added!');
    }

}
