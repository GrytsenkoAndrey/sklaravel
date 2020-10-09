<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::latest()->get()->where('published', 1);
        return view('posts.posts', compact('posts'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $afterValidate = request()->validate([
            'slug' => 'required|max:6',
            'title' => ['required', 'min:5', 'max:100'],
            'description' => ['required', 'max:255'],
            'content' => 'required',
        ]);

        $afterValidate['published'] = \request()->has('published') ? '1' : '0';

        Post::create($afterValidate);

        return redirect('/posts/');
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Post $post)
    {
        $afterValidate = request()->validate([
            'title' => ['required', 'min:5', 'max:100'],
            'description' => ['required', 'max:255'],
            'content' => 'required',
        ]);

        $afterValidate['published'] = \request()->has('published') ? '1' : '0';

        $post->update($afterValidate);

        return redirect('/posts/');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts/');
    }
}
