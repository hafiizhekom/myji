<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoDetail extends Model
{

    protected $table = 'promo_detail';
    protected $fillable = ['promo_id','product_detail_id'];
    
    public function promo()
    {
        return $this->belongsTo('App\Models\Promo', 'promo_id');
    }

    public function productDetail()
    {
        return $this->belongsTo('App\Models\ProductDetail', 'product_detail_id');
    }
}
