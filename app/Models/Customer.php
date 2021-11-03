<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customer';
    protected $fillable = ['first_name', 'last_name', 'gender', 'email', 'phone', 'address'];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

}
