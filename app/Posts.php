<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // array allowed
    public $fillable = ['slug', 'title', 'description', 'content', 'created_at', 'published'];
}
