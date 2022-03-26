<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TagController extends Controller
{
    public function show(Request $request, Tag $tag)
    {
        $taggables = $tag->taggables;

        $currentPage = $request->get('page', 1);
        $perPage = 1;

        $taggables = new LengthAwarePaginator(
            $taggables->forPage($currentPage, $perPage),
            \count($taggables),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('tag.show', compact('tag', 'taggables'));
    }
}
