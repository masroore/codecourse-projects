@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your companies</div>

                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($companies as $company)
                            <a href="/{{ $company->id }}" class="list-group-item">{{ $company->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
