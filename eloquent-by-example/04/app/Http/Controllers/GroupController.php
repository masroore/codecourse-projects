<?php

namespace App\Http\Controllers;

use App\Group;

class GroupController extends Controller
{
    public function show(Group $group)
    {
        dd($group->topics()->get());
    }
}
