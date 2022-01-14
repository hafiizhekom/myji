<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Refund extends Model
{
    use SoftDeletes;

    protected $table = 'refund';
    protected $fillable = ['order_detail_id', 'type', 'quantity', 'stock_flow', 'reason'];

    public function orderDetail()
    {
        return $this->belongsTo('App\Models\OrderDetail')->withTrashed();
    }
 
}
