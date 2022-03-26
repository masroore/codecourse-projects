<x-app-layout>
    <p>You must verify your account before accessing this</p>

    @if (session('status') === 'verification-link-sent')
        <p>
            A verification email has been sent
        </p>
    @endif

    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <button type="submit">Resend email</button>
    </form>
</x-app-layout>