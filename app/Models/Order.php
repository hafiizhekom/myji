<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';
    protected $fillable = ['channel_id', 'customer_id', 'discount_amount', 'address_shipping', 'total_price', 'order_date', 'type_order', 'return_order'];

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

}
