<x-app-layout>
    <form action="/two-factor-challenge" method="post">
        @csrf

        <div>
            <label for="code">Code</label>
            <input type="text" name="code" id="code">

            @error('code')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="recovery_code">Recovery code</label>
            <input type="text" name="recovery_code" id="recovery_code">

            @error('recovery_code')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Continue</button>
    </form>
</x-app-layout>
