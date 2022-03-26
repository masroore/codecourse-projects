@foreach ($taggables as $item)
    <div class="item">
        <h3>{{ $item->title }}</h3>
    </div>
@endforeach

{{ $taggables->appends('q', request()->get('q'))->links() }}

{{-- <h2>Topics</h2>

@foreach ($tag->topics as $topic)
    <div class="topic">
        <h3>{{ $topic->title }}</h3>
    </div>
@endforeach

<h2>Lessons</h2>

@foreach ($tag->lessons as $lesson)
    <div class="lesson">
        <h3>{{ $lesson->title }}</h3>
    </div>
@endforeach
 --}}