@foreach ($topics as $topic)
    <h4><a href="{{ route('topics.show', $topic) }}">{{ $topic->title }}</a> ({{$topic->posts->count() }} posts)</h4>
    <p>by {{ $topic->user->name }}</p>
@endforeach