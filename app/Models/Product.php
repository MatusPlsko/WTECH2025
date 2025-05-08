<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // ktoré polia môžeme hromadne vkladať
    protected $fillable = ['name','description','price','stock_quantity','image_url','sale','rating'];


    // definícia 1:N vzťahu na obrázky
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
