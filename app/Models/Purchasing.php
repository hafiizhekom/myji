<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Purchasing extends Model
{
    use SoftDeletes;

    protected $table = 'purchasing';
    protected $fillable = ['po_code','item', 'supplier_name', 'unit', 'unit_price', 'total_price', 'shipping_cost', 'total_price_with_shipping', 'discount_amount', 'discount_percentage', 'order_date', 'estimation_date'];

    public function production()
    {
        return $this->hasOne('App\Models\Production')->withTrashed();
    }
}
