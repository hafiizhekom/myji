<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Production extends Model
{
    use SoftDeletes;

    protected $table = 'production';
    protected $fillable = ['purchasing_id','product_detail_id', 'request', 'actual', 'defect'];

    public function purchasing()
    {
        return $this->belongsTo('App\Models\Purchasing', 'purchasing_id');
    }

    public function productDetail()
    {
        return $this->belongsTo('App\Models\ProductDetail', 'product_detail_id');
    }
}
