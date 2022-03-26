@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Tokens</div>

                <div class="card-body">
                    @if($tokens->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Token</th>
                                    <th>Abilities</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tokens as $token)
                                    <tr>
                                        <td>
                                            {{ $token->name }}
                                        </td>
                                        <td>
                                            @foreach($token->abilities as $tokenAbility)
                                                {{ $tokenAbility }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $token->created_at->toDateTimeString() }}
                                        </td>
                                        <td>
                                            <form action="{{ route('apitokens') }}/{{ $token->id }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Revoke</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0">No tokens created</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Create a token</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('apitokens') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                Name
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                @foreach ($apiAbilities as $apiAbility)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="abilities[{{ $apiAbility->id }}]" id="abilities[{{ $apiAbility->id }}]" {{ in_array($apiAbility->id, old('abilities') ?? []) ? 'checked' : '' }} value="{{ $apiAbility->id }}">

                                        <label for="abilities[{{ $apiAbility->id }}]">
                                            {{ $apiAbility->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
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
