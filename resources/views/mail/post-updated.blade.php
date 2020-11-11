@component('mail::message')

# Обновлена статья {{ $post->title }}

The body of your message.
{{ $post->description }}

@component('mail::button', ['url' => route('post.show', $post->getRouteKey)])
Смотреть статью
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
