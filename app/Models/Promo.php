<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public function products()
    {
        return $this->belongsToMany(ProductSize::class, 'promo_product_size', 'promo_id', 'product_size_id');
    }
}
