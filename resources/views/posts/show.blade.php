@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            {{ $title }} / {{ $created_at }}
        </h3>
        <p>{{ $slug }}</p>
        <p>{{ $content }}</p>
    </div>
@endsection