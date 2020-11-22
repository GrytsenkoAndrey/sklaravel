<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // array allowed
    protected $fillable = ['email', 'content', 'created_at'];
}
