@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Impersonate a user</div>

                <div class="panel-body">
                    <form action="{{ route('admin.impersonate.start') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">User email</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('identifier') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Impersonate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
