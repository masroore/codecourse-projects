<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSeriesFormRequest;
use App\Jobs\UpdateSeriesParts;
use App\Series;

class SeriesController extends Controller
{
    public function edit(Series $series)
    {
        $series->load('parts');

        return view('series.edit', compact('series'));
    }

    public function update(UpdateSeriesFormRequest $request, Series $series)
    {
        $series->title = $request->title;
        $series->save();

        dispatch(new UpdateSeriesParts($series, $request->parts));

        return response(null, 200);
    }
}
