<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';
    protected $fillable = ['product_code', 'product_name', 'description',  'color_id', 'category_id', 'image_file', 'view'];

    public function detail()
    {
        return $this->hasOne('App\Models\ProductDetail');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
