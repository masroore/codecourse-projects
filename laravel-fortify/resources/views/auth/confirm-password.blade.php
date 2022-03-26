<x-app-layout>
    <form action="{{ route('password.confirm') }}" method="post">
        @csrf

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Continue</button>
    </form>
</x-app-layout>
