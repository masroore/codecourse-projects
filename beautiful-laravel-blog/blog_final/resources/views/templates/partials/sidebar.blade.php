@if ($tags->count())
    <h3>Tags</h3>
    
    @foreach ($tags as $tag)
        <a href="{{ route('posts.tagged', $tag->slug) }}" class="tag">{{ $tag->name }}</a>
    @endforeach
@endif
