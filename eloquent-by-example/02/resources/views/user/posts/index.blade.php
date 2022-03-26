@foreach ($posts as $post)
    <div class="post">
        <h4>{{ $post->body }}</h4>
        <p>Belongs to <a href="{{ route('topics.show', $post->topic) }}">{{ $post->topic->title }}</a></p>
    </div>
@endforeach