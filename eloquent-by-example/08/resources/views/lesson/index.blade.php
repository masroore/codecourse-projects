@foreach ($lessons as $lesson)
    <div class="lesson">
        <h3>{{ $lesson->title }}</h3>
        
        @foreach ($lesson->tags as $tag)
            <div class="tag">{{ $tag->name }}</div>
        @endforeach
    </div>
@endforeach