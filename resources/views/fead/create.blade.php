@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Добавить отзыв
        </h3>
        @include('layout.errors')
        <form method="POST" action="{{ route('feedback.store') }}">

            @csrf

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="content">Сообщение</label>
                <input type="text" class="form-control" id="content" name="content" required>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Отправить</button>
        </form>
    </div>
@endsection
