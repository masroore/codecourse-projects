@extends('templates/app')

@section('header')
    @include('post/partials/image', [
        'url' => $post->image
    ])
@endsection

@section('main')
    <article class="article">
        <div class="author">
            <img src="{{ $post->author->avatar() }}" alt="{{ $post->author->fullName() }}" class="author__image">
            <div class="author__details">
                <a href="" class="author__name">{{ $post->author->fullName() }}</a>
                <div class="author__post-time">{{ $post->created_at->diffForHumans() }}</div>
            </div>
        </div>

        <h1 class="article__header">{{ $post->title }}</h1>
        <h2 class="article__subheader">{{ $post->teaser }}</h2>
        <div class="article__body">
            {!! Markdown::convertToHtml(e($post->body)) !!}
        </div>

        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.tagged', $tag->slug) }}" class="tag">{{ $tag->name }}</a>
        @endforeach
    </article>
@endsection
