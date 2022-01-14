<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SettingMostWanted extends Model
{
    use SoftDeletes;

    protected $table = 'setting_most_wanted';
    protected $fillable = ['product_id', 'order'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->withTrashed();
    }

}
