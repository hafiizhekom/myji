<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SettingOrder extends Model
{
    use SoftDeletes;

    protected $table = 'setting_order';
    protected $fillable = ['order_fee', 'active'];

}
