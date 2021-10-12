<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    protected $table = 'channel';
    protected $fillable = ['channel_name','fixed_fee','percentage_fee','active'];
}
