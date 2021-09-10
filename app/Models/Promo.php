<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{

    protected $table = 'promo';
    protected $fillable = ['promo_name','fixed_amount','percentage_amount','start_time','end_time','active'];
    public function products()
    {
        return $this->belongsToMany(ProductSize::class, 'promo_product_size', 'promo_id', 'product_size_id');
    }
}
