<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{

    protected $fillable = [
        'name','description','price','stock_quantity',
        'category_id','sale','brand','image_url','rating'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

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

    public function scopeFullTextSearch(Builder $query, string $term): Builder
    {
        return $query->where(function(Builder $q) use ($term) {
            // 1) Full-text (Postgres tsvector)
            $q->whereRaw(
                "to_tsvector('english', coalesce(name,'') || ' ' || coalesce(description,''))
                 @@ websearch_to_tsquery('english', ?)",
                [$term]
            )
                // 2) alebo názov obsahuje reťazec (case-insensitive)
                ->orWhere('name', 'ILIKE', "%{$term}%")
                // 3) alebo popis obsahuje reťazec
                ->orWhere('description', 'ILIKE', "%{$term}%");
        });
    }

    protected function prepareTerm(string $term): string
    {
        $words = array_filter(explode(' ', $term));
        $prefixed = array_map(fn($w) => '+' . $w . '*', $words);
        return implode(' ', $prefixed);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
