<style>
    .comment .comment {
        margin-left: 20px;
    }
</style>

<h2>{{ $video->title }}</h2>

@include ('partials._comments', ['comments' => $video->comments])