<?php

namespace App\Http\Controllers;

use App\Models\Link;

class LinkController extends Controller
{
    public function get($code, Link $link)
    {
        $link = $link->withCode($code)->first();

        if (!$link) {
            return abort(404);
        }

        return redirect()->to($link->getUrl());
    }
}
