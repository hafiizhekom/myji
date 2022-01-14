<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EndorseDetail extends Model
{
    use SoftDeletes;

    protected $table = 'endorse_detail';
    protected $fillable = ['endorse_id', 'product_detail_id', 'quantity'];


    public function productDetail() 
    {
        return $this->belongsTo('App\Models\ProductDetail', 'product_detail_id')->withTrashed();
    }

    public function endorse()
    {
        return $this->belongsTo('App\Models\Endorse', 'endorse_id')->withTrashed();
    }

    public function refund()
    {
        return $this->hasOne('App\Models\Refund')->withTrashed();
    }
}
