@component('mail::message')
{{
/** @var App\Post $post */
}}
# Создана новая статья {{ $post->title }}

The body of your message.
{{ $post->description }}

@component('mail::button', ['url' => '/posts/' . $post->slug])
Смотреть статью
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
