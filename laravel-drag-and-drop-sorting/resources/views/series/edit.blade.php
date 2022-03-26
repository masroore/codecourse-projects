@extends('layouts.app')

@section('content')
    <series-edit :data="{{ $series->toJson() }}"></series-edit>
@endsection
