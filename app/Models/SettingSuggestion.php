<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SettingSuggestion extends Model
{
    use SoftDeletes;

    protected $table = 'setting_suggestion';
    protected $fillable = ['product_id', 'order'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->withTrashed();
    }

}
