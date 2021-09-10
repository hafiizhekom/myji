<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'product';
    protected $fillable = ['product_code', 'product_name', 'view'];

    public function detail()
    {
        return $this->hasOne('App\Models\ProductDetail');
    }
}
