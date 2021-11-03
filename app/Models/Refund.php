<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{

    protected $table = 'refund';
    protected $fillable = ['order_detail_id', 'type', 'stock_flow', 'reason'];

    public function orderDetail()
    {
        return $this->belongsTo('App\Models\OrderDetail');
    }
 
}
