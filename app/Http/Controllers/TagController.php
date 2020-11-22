<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->post()->with('tag')->get();

        return view('posts.posts', compact('posts'));
    }
}
