<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderDetail extends Model
{
    use SoftDeletes;

    protected $table = 'order_detail';
    protected $fillable = ['order_id', 'product_detail_id', 'quantity', 'price', 'total_price', 'status'];


    public function productDetail() 
    {
        return $this->belongsTo('App\Models\ProductDetail', 'product_detail_id')->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id')->withTrashed();
    }

    public function refund()
    {
        return $this->hasOne('App\Models\Refund')->withTrashed();
    }
}
