<h2>{{ $lesson->title }}</h2>

@foreach ($lesson->tags as $tag)
    <div class="tag">
        <a href="{{ route('tag.show', $tag) }}">{{ $tag->name }}</a>
    </div>
@endforeach