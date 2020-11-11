<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Mail\PostCreated;
use App\Mail\PostDeleted;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,post')->except(['index', 'store', 'create', 'show', 'edit']);
    }

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
        #$post = $post->with('user');
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
        $afterValidate['user_id'] = auth()->id();
        /** @var \App\Post $post */
        $post = Post::create($afterValidate);

        # send notification
        \Mail::to($post->users->email)->send(
            new PostCreated($post)
        );

        /**
         * валидируем полученные теги из запроса (валидация возвращает массив)
         * массив в строку с разделителем
         * строку с разделителем в массив
         */
        $tags = collect(explode(',', implode(',', request()->validate(['tag' => 'required']))))
            ->keyBy(function ($item) { return $item; });
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $post->tag()->attach($tag);
        }

        return redirect(route('site.posts'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        /* лучше сделать через Policies/PostPolicy
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }
        */
        $this->authorize('edit', $post);

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
        $afterValidate['user_id'] = auth()->id();

        $post->update($afterValidate);

        # send notification
        \Mail::to($post->users->email)->send(
            new PostCreated($post)
        );

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

        return redirect(route('site.posts'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        # send notification
        \Mail::to($post->users->email)->send(
            new PostDeleted($post)
        );

        return redirect(route('site.posts'));
    }
}
