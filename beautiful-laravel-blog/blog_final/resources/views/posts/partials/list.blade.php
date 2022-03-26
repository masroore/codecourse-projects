@if ($posts->count())
    @foreach ($posts as $post)
        <div class="post">
            <div class="post__header"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></div>
            <div class="post__author">By <a href="#">{{ $post->author->fullName() }}</a> <span class="post__time">{{ $post->created_at->diffForHumans() }}</span></div>
            <div class="post__preview">{{ $post->teaser }}</div>
        </div>
    @endforeach
@else
    <p>No posts to see here</p>
@endif
