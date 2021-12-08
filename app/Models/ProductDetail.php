<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductDetail extends Model
{
    use SoftDeletes;

    protected $table = 'product_detail';
    protected $fillable = ['product_id', 'size_id', 'price', 'yard_per_piece', 'image_file', 'shopee_link', 'whatsapp_link'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    
    public function size()
    {
        return $this->belongsTo('App\Models\Size', 'size_id');
    }


    public function production()
    {
        return $this->hasMany('App\Models\Production');
    }

    public function promoDetail()
    {
        return $this->hasMany('App\Models\PromoDetail');
    }
}
