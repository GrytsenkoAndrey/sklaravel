@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Добавить статью
        </h3>
        @include('layout.errors')
        <form method="POST" action="/posts">

            @csrf
            <div class="form-group">
                <label for="slug">Номер (уникальный)</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>

            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" id="description" name="description" >
            </div>

            <div class="form-group">
                <label for="content">Текст</label>
                <textarea class="form-control" id="content" rows="3" name="content"></textarea>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="published" value="1" name="published">
                <label class="form-check-label" for="published">Опубликована</label>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Add article</button>
        </form>
    </div>
@endsection