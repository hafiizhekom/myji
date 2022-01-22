<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SettingSizeChart extends Model
{
    use SoftDeletes;

    protected $table = 'setting_size_chart';
    protected $fillable = ['image_file','order'];
}
