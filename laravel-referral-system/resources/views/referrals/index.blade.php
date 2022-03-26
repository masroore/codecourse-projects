@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Referrals</div>

                <div class="card-body">
                    @if($referrals->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Completed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($referrals as $referral)
                                    <tr>
                                        <td>
                                            {{ $referral->email }}
                                        </td>
                                        <td>
                                            {{ $referral->created_at->toDateString() }}
                                        </td>
                                        <td>
                                            @if($referral->completed)
                                                Yes
                                            @else
                                                No &nbsp; <a href="{{ route('index', ['referral' => $referral->token]) }}" target="_blank">Get link</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0">
                            No referrals right now
                        </p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Refer a friend</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('referrals') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
