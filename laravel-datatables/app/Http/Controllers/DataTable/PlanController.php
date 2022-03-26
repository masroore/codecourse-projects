<?php

namespace App\Http\Controllers\DataTable;

use App\Plan;
use Illuminate\Http\Request;

class PlanController extends DataTableController
{
    public function builder()
    {
        return Plan::query();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'braintree_id' => 'required',
            'active' => 'required',
        ]);

        $this->builder->create($request->only($this->getUpdatableColumns()));
    }
}
