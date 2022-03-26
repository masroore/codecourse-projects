<?php

use App\User;

Route::get('/', function () {
    $user = User::find(1);

    $user->update([
        'name' => 'Billy',
        'email' => 'billy@codecourse.com',
    ]);
});

Route::get('/users/{user}/history', function (User $user) {
    return view('users.history', [
        'histories' => $user->history,
    ]);
});
