<h2>{{ $article->title }}</h2>

@if ($article->comments->count())
    @foreach ($article->comments as $comment)
        <div class="comment">
            <p>{{ $comment->body }}</p>
            <small>by {{ $comment->user->name }}</small>
        </div>
    @endforeach
@endif
