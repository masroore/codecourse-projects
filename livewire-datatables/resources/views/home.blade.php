@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   <livewire:datatable model="App\User" exclude="password,remember_token" paginate="20" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
