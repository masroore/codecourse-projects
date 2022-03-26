@foreach ($comments as $comment)
    <div class="comment">
        <strong>{{ $comment->user->name }}</strong> &bull; {{ $comment->created_at->diffForHumans() }}
        <p>{{ $comment->body }}</p>

        @if ($comment->comment)
            <p>In reply to {{ $comment->comment->user->name }}</p>
        @endif
        
        <p><a href="{{ route('comment.store', [$video, $comment]) }}">Reply</a></p>

        @include ('partials._comments', ['comments' => $comment->replies])
    </div>
@endforeach
