<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="/posts/{{ $post->slug }}" title="{{ $post->title }}" target="_blank">{{ $post->title }}</a>
    </h2>
    <p class="blog-post-meta">{{ $post->created_at }}</p>

    @include('posts.tag', ['tags' => $post->tag])

    <p>{{ $post->description }}</p>
</div><!-- /.blog-post -->