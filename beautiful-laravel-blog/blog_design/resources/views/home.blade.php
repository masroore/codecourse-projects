@extends('templates/app')

@section('main')
    <div class="content">
        @include('posts/partials/list')
    </div>
    <div class="sidebar">
        @include('templates/partials/sidebar')
    </div>
@endsection
