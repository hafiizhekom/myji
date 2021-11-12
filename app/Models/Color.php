<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Color extends Model
{
    use SoftDeletes;

    protected $table = 'color';
    protected $fillable = ['color_code', 'color_name', 'color_hex'];

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
