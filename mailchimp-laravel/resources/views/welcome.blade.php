<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
    </head>
    <body>
        <form action="{{ route('newsletter.create') }}" method="post">
            <label for="email">
                Email
                <input type="text" name="email" id="email">
            </label>
            @if ($errors->has('email'))
                <div class="error">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <input type="submit" value="Sign up">
            {{ csrf_field() }}
        </form>
    </body>
</html>