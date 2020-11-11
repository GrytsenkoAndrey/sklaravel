@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Добавить статью
        </h3>
        @include('layout.errors')
        <form method="POST" action="{{ route('post.create') }}">

            @csrf
            <div class="form-group">
                <label for="slug">Номер (уникальный)</label>
                <input type="text"
                       class="form-control"
                       maxlength="6"
                       id="slug"
                       name="slug"
                       required
                       value="{{ old('slug') }}"
                />
            </div>

            <div class="form-group">
                <label for="title">Название</label>
                <input type="text"
                       class="form-control"
                       id="title"
                       maxlength="100"
                       name="title"
                       required
                       value="{{ old('title') }}"
                />
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text"
                       class="form-control"
                       id="description"
                       name="description"
                       value="{{ old('description') }}"
                />
            </div>

            <div class="form-group">
                <label for="content">Текст</label>
                <textarea class="form-control"
                          id="content"
                          rows="3"
                          name="content">{{ old('content') }}
                </textarea>
            </div>

            <div class="form-check form-check-inline">
                <label for="tag">Теги</label>
                <input type="text"
                       class="form-control"
                       id="tag"
                       name="tag"
                       required
                       value="{{ old('tag') }}"
                        />
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input"
                       type="checkbox"
                       id="published"
                       name="published"
                />
                <label class="form-check-label" for="published">Опубликована</label>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Добавить статью</button>
        </form>
    </div>
@endsection
