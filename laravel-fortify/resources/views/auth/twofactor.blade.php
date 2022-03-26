<x-app-layout>
    @if(session('status') === 'two-factor-authentication-enabled')
        <p>Two factor authentication has been enabled. Scan the QR code with your authenticator app.</p>

        {!! auth()->user()->twoFactorQrCodeSvg() !!}
    @endif

    @if (auth()->user()->two_factor_secret)
        <p>Recovery code</p>

        <ul>
            @foreach (auth()->user()->recoveryCodes() as $code)
                <li>{{ $code }}</li>
            @endforeach
        </ul>

        <form action="/user/two-factor-authentication" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Disable</button>
        </form>
    @else
        <form action="/user/two-factor-authentication" method="post">
            @csrf
            <button type="submit">Enable</button>
        </form>
    @endif
</x-app-layout>
