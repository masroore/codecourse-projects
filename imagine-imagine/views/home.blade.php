@extends('templates.default')

@section('content')
    <div class="row">
        <div class="large-6 large-offset-3 columns">
            <div class="container">
                <form action="{{ route('image.create') }}" method="post" enctype="multipart/form-data">
                    <input type="file" name="image">
                    <button class="expand">Upload</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
@endsection