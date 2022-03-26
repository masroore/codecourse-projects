<x-app-layout>
    <form action="{{ route('password.request') }}" method="post">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">

            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Request password reset</button>
    </form>
</x-app-layout>
