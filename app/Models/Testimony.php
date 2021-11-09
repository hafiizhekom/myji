<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Testimony extends Model
{
    use SoftDeletes; 
    protected $table = 'testimony';
    protected $fillable = ['title','image','content'];
}
