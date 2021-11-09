<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{

    use SoftDeletes;
    protected $table = 'size';
    protected $fillable = ['size_code','size_name'];

    public function productDetail()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }
}
