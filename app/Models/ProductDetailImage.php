<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductDetailImage extends Model
{
    use SoftDeletes;

    protected $table = 'product_detail_image';
    protected $fillable = ['product_detail_id', 'file', 'main_image'];

    public function productDetail()
    {
        return $this->belongsTo('App\Models\ProductDetail', 'product_detail_id');
    }
    
}
