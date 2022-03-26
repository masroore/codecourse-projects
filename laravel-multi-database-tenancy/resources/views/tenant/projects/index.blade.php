@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ request()->tenant()->name }} projects</div>

                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group">
                            @foreach ($projects as $project)
                                <a href="{{ route('projects.show', $project) }}" class="list-group-item">{{ $project->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">New project</div>

                <div class="card-body">
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="control-label">Project name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
