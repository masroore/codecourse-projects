@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Show topic #1</div>

                <div class="panel-body">
                    @can('edit posts')
                        <a href="">Edit post</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
