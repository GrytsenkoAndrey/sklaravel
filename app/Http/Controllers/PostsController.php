<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::latest()->get()->where('published', 1);
        return view('posts.posts', compact('posts'));
    }

    public function show(Posts $post)
    {
        $data = json_decode($post);

        return view('posts.show', [
            'title'      => $data->title,
            'created_at' => $data->created_at,
            'slug'       => $data->slug,
            'content'    => $data->content
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $afterValidate = $this->validate(request(), [
            'slug' => 'required|max:6',
            'title' => ['required', 'min:5', 'max:100'],
            'description' => ['required', 'max:255'],
            'content' => 'required',
        ]);

        $afterValidate['published'] = request('published');

        Posts::create($afterValidate);

        return redirect('/');
    }
}
