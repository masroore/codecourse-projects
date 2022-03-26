@extends('templates/app')

@section('main')
    <div class="content">
        <h3>Tagged in: Coding</h3>
        @include('posts/partials/list')
    </div>
    <div class="sidebar">
        @include('templates/partials/sidebar')
    </div>
@endsection
