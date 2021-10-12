<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{

    protected $table = 'product_detail';
    protected $fillable = ['product_id', 'size_id', 'color_id', 'category_id', 'price', 'yard_per_piece', 'design_image_path'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    
    public function size()
    {
        return $this->belongsTo('App\Models\Size', 'size_id');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function production()
    {
        return $this->hasMany('App\Models\Production');
    }
}
