@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Редактировать статью
        </h3>
        @include('layout.errors')
        <form method="POST" action="{{ route('post.update', $post) }}">

            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text"
                       class="form-control"
                       id="title"
                       name="title"
                       maxlength="100"
                       required
                       value="{{ old('title', $post->title) }}"
                />
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text"
                       class="form-control"
                       id="description"
                       name="description"
                       value="{{ old('description', $post->description) }}"
                />
            </div>

            <div class="form-group">
                <label for="content">Текст</label>
                <textarea class="form-control"
                          id="content"
                          rows="3"
                          name="content">{{ old('content', $post->content) }}
                </textarea>
            </div>

            <div class="form-check form-check-inline">
                <label for="tag">Теги</label>
                <input type="text"
                       class="form-control"
                       id="tag"
                       name="tag"
                       required
                       value="{{ old('tag', $post->tag->pluck('name')->implode(',')) }}"
                />
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input"
                       type="checkbox"
                       id="published"
                       {{ $post->published ? 'checked' : '' }}
                       name="published"
                />
                <label class="form-check-label" for="published">Опубликована</label>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Редактировать</button>
        </form>
        <form method="POST" action="{{ route('post.delete', $post->getRouteKey()) }}" class="mt-2 mb-2">

            @csrf
            @method('DELETE')
            <button class="btn btn-danger"
                    type="submit"
                    >Удалить</button>
        </form>
    </div>
@endsection
