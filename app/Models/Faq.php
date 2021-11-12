<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Faq extends Model
{
    use SoftDeletes;

    protected $table = 'faq';
    protected $fillable = ['title', 'content', 'order'];

}
