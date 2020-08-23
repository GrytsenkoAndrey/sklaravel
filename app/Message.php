<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // array allowed
    public $fillable = ['email', 'content', 'created_at'];
}
