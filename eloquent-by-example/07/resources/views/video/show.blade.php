<h2>{{ $video->title }}</h2>

@if ($video->comments->count())
    @foreach ($video->comments as $comment)
        <div class="comment">
            <p>{{ $comment->body }}</p>
            <small>by {{ $comment->user->name }}</small>
        </div>
    @endforeach
@endif
