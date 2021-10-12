<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{

    protected $table = 'size';
    protected $fillable = ['size_code','size_name'];

    public function productDetail()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }
}
