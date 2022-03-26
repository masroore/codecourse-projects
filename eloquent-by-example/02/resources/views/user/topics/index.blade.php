@foreach ($topics as $topic)
    <h4><a href="{{ route('topics.show', $topic) }}">{{ $topic->title }}</a></h4>
    <p>{{ $topic->created_at->diffForHumans() }}</p>
@endforeach