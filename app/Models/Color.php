<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'color';
    protected $fillable = ['color_code', 'color_name'];

    public function productDetail()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }
}
