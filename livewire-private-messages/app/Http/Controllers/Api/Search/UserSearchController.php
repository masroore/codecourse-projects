<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSearchController extends Controller
{
    public function index(Request $request)
    {
        if (!$q = $request->get('q', '')) {
            return response()->json([]);
        }

        return User::where(DB::raw('LOWER(name)'), 'LIKE', '%' . Str::lower($q) . '%')
            ->get(['id', 'name']);
    }
}
