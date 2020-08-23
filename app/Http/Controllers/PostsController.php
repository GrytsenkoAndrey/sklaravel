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
        //$post = Posts::find($slug);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $afterValidate = $this->validate(request(), [
            'slug' => 'required',
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
        ]);

        $afterValidate['published'] = request('published');

        Posts::create($afterValidate);

        /*
        Article::create(request()->all());

        // create article
        $article = new Article();

        $article->title = request('title');
        $article->description = request('desc');
        $article->content = request('content');
        $article->created_at = date('Y-m-d H:i:s');
        // save to DB
        $article->save();
        // redirect to articles page*/


        return redirect('/');
    }
}
