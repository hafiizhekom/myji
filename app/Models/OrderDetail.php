<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $table = 'order_detail';
    protected $fillable = ['order_id', 'product_detail_id', 'quantity', 'price', 'status'];


    public function productDetail() 
    {
        return $this->belongsTo('App\Models\ProductDetail', 'product_detail_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function refund()
    {
        return $this->hasOne('App\Models\Refund');
    }
}
