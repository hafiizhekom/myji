<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{

    protected $table = 'volume';
    protected $fillable = ['volume_code', 'volume_name'];

    public function productDetail()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }
}
