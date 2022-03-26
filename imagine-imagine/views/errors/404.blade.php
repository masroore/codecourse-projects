@extends('templates.default')

@section('content')
    <div class="row">
        <div class="large-6 large-offset-3 columns">
            <div class="container">
                <p>Sorry that image can't be found.</p>
            </div>
            <a href="{{ route('home') }}">Upload your own image</a>
        </div>
    </div>
@endsection