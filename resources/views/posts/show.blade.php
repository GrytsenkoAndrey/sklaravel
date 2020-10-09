@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            {{ $post->title }} / {{ $post->created_at }}
        </h3>
        <p>{{ $post->slug }}  <a href="/posts/{{ $post->slug }}/edit" title="Edit" class="ml-1">Редактировать</a></p>

        @include('posts.tag', ['tags' => $post->tag])

        <p>{{ $post->content }}</p>
    </div>
@endsection