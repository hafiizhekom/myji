<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'order';
    protected $fillable = ['channel_id', 'customer_id', 'promo_id', 'discount_amount', 'discount_percentage', 'address_shipping', 'total_price', 'order_date', 'type_order', 'return_order'];

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

}
