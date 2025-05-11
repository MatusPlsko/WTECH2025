<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{


    // Určte, ktoré stĺpce môžu byť hromadne priradené (mass assignable)
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // Relácia s produktom
    public function product()
    {
        return $this->belongsTo(Product::class); // Každý CartItem patrí jednému produktu
    }

    // Relácia s užívateľom
    public function user()
    {
        return $this->belongsTo(User::class); // Každý CartItem patrí jednému používateľovi
    }
}
