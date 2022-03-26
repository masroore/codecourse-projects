<x-app-layout>
    <form action="{{ route('password.update') }}" method="post">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ request()->email }}">

            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation">

            @error('password_confirmation')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <button type="submit">Reset password</button>
    </form>
</x-app-layout>
