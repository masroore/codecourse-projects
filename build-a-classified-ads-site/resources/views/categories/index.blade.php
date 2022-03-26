@extends('layouts.app')

@section('content')
    @include('listings.partials._search')
    
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4">
                <h5>{{ $category->name }}</h5>
                <hr>
                
                @foreach ($category->children as $sub)
                    <h5><a href="{{ route('listings.index', [$area, $sub]) }}">{{ $sub->name }}</a> ({{ $sub->listings->count() }})</h5>
                @endforeach

            </div>
        @endforeach
    </div>
@endsection
