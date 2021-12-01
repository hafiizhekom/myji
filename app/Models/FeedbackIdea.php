<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeedbackIdea extends Model
{
    use SoftDeletes;

    protected $table = 'feedback_idea';
    protected $fillable = ['url', 'ip_address'];
}
