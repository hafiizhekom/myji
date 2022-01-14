<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customer';
    protected $fillable = ['first_name', 'last_name', 'gender', 'email', 'phone', 'address'];

    public function order()
    {
        return $this->hasMany('App\Models\Order')->withTrashed();
    }

    public function endorse()
    {
        return $this->hasMany('App\Models\Endorse')->withTrashed();
    }

}
