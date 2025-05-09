<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // ktoré polia môžeme hromadne vkladať
    protected $fillable = [
        'name','description','price','stock_quantity',
        'category_id','sale','image_url','rating'
    ];


    // definícia 1:N vzťahu na obrázky
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
