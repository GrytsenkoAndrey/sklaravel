@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            {{ $post->title }} / {{ $post->created_at }}
        </h3>
        <p>{{ $post->slug }}{{-- {{ $post->user->name }}--}}
            @can('update', $post)
            <a href="{{ route('post.edit', $post) }}" title="Edit" class="ml-1">Редактировать</a>
            @endcan
        </p>

        @include('posts.tag', ['tags' => $post->tag])

        <p>{{ $post->content }}</p>
    </div>
@endsection
