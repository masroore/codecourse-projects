@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-4">{{ $project->name }}</h3>

            <div class="card">
                <div class="card-header">Files</div>

                <div class="card-body">
                    <div class="list-group mb-4">
                        <div class="list-group">
                            @foreach($project->files as $file)
                                <a href="" class="list-group-item">{{ $file->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('projects.files.store', $project) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="file" class="control-label">Upload a file</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
