@extends('layouts.app')

@section('content')
    <p>Showing your last {{ $indexLimit }} viewed listings.</p>
    @if ($listings->count())
        @each ('listings.partials._listing', $listings, 'listing')
    @else
        <p>You have no viewed listings.</p>
    @endif
@endsection
