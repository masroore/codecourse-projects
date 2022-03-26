<x-app-layout>
    <form action="{{ route('auth.delete') }}" method="post">
        @csrf

        <button type="submit">Delete</button>
    </form>
</x-app-layout>
