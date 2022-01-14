<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{

    use SoftDeletes;

    protected $table = 'channel';
    protected $fillable = ['channel_name','fixed_fee','percentage_fee','active'];

    public function order()
    {
        return $this->hasOne('App\Models\Order')->withTrashed();
    }
}
