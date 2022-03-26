<?php

use App\Step;

Route::get('/steps', function () {
    return Step::orderBy('order', 'asc')->get();
});

Route::get('/steps/create', function () {
    $order = Step::find(17)->ordering()->after();

    $newStep = Step::create([
        'title' => 'New step',
        'order' => $order,
    ]);
});

Route::get('/steps/refresh', function () {
    return Step::orderBy('order', 'asc')->get()->each(function ($step, $index) {
        $step->update([
            'order' => $index + 1,
        ]);
    });
});

Route::get('/steps/update', function () {
    $order = Step::find(2)->ordering()->before();

    Step::find(4)->update([
        'order' => $order,
    ]);
});
