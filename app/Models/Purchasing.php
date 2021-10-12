<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{

    protected $table = 'purchasing';
    protected $fillable = ['po_code','item', 'unit', 'unit_price', 'total_price', 'shipping_cost', 'total_price_with_shipping', 'discount_amount', 'discount_percentage'];

    public function production()
    {
        return $this->hasOne('App\Models\Production');
    }
}
