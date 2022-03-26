<h4>{{ $topic->title }}</h4>

@if ($topic->posts->count())
    @foreach ($topic->posts as $post)
        <div class="post">
            <p>{{ $post->body }}</p>
            <p>by {{$post->user->name }}</p>
        </div>
    @endforeach
@else
    <p>No posts</p>
@endif