<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Promo extends Model
{
    use SoftDeletes;

    protected $table = 'promo';
    protected $fillable = ['promo_name','fixed_amount','percentage_amount','start_time','end_time','active'];
    
    public function detail()
    {
        return $this->hasMany('App\Models\PromoDetail');
    }
}
