@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Сообщения
        </h3>

        @foreach($messages as $message)
            @include('fead.item')
        @endforeach
    </div>
@endsection