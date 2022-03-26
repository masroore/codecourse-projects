<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Imagine</title>

        <link rel="stylesheet" href="{{ asset('css/foundation.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <div class="logo">
                    <a href="{{ route('home') }}">Imagine</a>
                </div>
                @yield('content')
            </div>
        </div>
    </body>
</html>