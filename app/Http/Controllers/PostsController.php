<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('tag')->latest()->get()->where('published', 1);
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

        dd(Post::create($afterValidate));

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

        /** @var Collection $postTags */
        $postTags = $post->tag->keyBy('name');
        $tag = collect(explode(',', request('tag')))->keyBy(function ($item) { return $item; });
        /* FIRST variant
        $tagsToAttach = $tag->diffKeys($postTags);
        $tagsToDetach = $postTags->diffKeys($tag);

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $post->tag()->attach($tag);
        }

        foreach ($tagsToDetach as $tag) {
            $post->tag()->detach($tag);
        }*/

        /** SECOND variant */
        $syncIds = $postTags->intersectByKeys($tag)->pluck('id')->toArray();
        $tagsToAttach = $tag->diffKeys($postTags);
        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }
        $post->tag()->sync($syncIds);

        return redirect('/posts/');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts/');
    }
}
