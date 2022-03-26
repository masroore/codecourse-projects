<x-app-layout>
    <form action="{{ route('user-password.update') }}" method="post">
        @csrf
        @method('PUT')

        @if (session('status') === 'password-updated')
            <p>Your password has been updated</p>
        @endif

        <div>
            <label for="current_password">Current password</label>
            <input type="password" name="current_password" id="current_password">

            @error('current_password')
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

        <button type="submit">Change password</button>
    </form>
</x-app-layout>
