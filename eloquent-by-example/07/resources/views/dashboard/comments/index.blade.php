@foreach ($comments as $comment)
    <div class="comment">
        <p>{{ $comment->body }}</p>
        <a href="{{ route($comment->commentable->getRouteIdentifier() . '.show', $comment->commentable) }}">{{ $comment->commentable->getTitle() }}</a>
    </div>
@endforeach
