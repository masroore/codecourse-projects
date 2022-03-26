@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Tasks</div>

                    <div class="panel-body">
                        {{-- @include('common.errors') --}}

                        <form action="{{ route('tasks.store') }}" method="post" class="form-horizontal">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">Task</label>

                                <div class="col-sm-6">
                                    <input type="text" name="name" id="name" class="form-control">
                                    
                                    @if ($errors->has('name'))
                                        <div class="help-block">
                                            Name is required
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">Add task</button>
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Current tasks</div>

                    <div class="panel-body">
                        @if ($tasks->count())
                            <table class="table table-striped">
                                <thead>
                                    <th>Task</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->name }}</td>
                                            <td>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>You have no tasks!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
