<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = 'post';
    // array allowed
    public $fillable = ['slug', 'title', 'description', 'content', 'created_at', 'published'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
