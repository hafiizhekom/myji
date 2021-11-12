<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    protected $table = 'category';
    protected $fillable = ['category_code', 'category_name'];

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
