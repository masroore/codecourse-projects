@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subscription</div>

                <div class="card-body">
                    <form action="{{ route('subscriptions') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Make payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
