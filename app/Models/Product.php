<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Scope pre full-textové vyhľadávanie
     *
     * @param  Builder  $query
     * @param  string   $term
     * @return Builder
     */

    public function scopeFullTextSearch(Builder $query, string $term)
    {
        // použijeme websearch_to_tsquery pre jednoduché hľadanie (podobné Google)
        $query->whereRaw(
            "to_tsvector('english', coalesce(name,'') || ' ' || coalesce(description,''))
             @@ websearch_to_tsquery('english', ?)",
            [$term]
        );
    }

    protected function prepareTerm(string $term): string
    {
        $words = array_filter(explode(' ', $term));
        $prefixed = array_map(fn($w) => '+' . $w . '*', $words);
        return implode(' ', $prefixed);
    }
}
