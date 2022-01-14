<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Endorse extends Model
{
    use SoftDeletes;

    protected $table = 'endorse';
    protected $fillable = ['channel_id', 'customer_id', 'address_shipping', 'endorse_date'];

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer')->withTrashed();
    }

    public function detail()
    {
        return $this->hasMany('App\Models\EndorseDetail')->withTrashed();
    }

}
