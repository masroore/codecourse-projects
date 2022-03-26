<?php

namespace App\Http\Controllers\DataTable;

use App\User;
use Illuminate\Http\Request;

class UserController extends DataTableController
{
    protected $allowCreation = false;

    public function builder()
    {
        return User::query();
    }

    public function getCustomColumnsNames()
    {
        return [
            'name' => 'Full name',
            'email' => 'Email address',
        ];
    }

    public function getDisplayableColumns()
    {
        return [
            'id',
            'name',
            'email',
            'created_at',
        ];
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id . '|email',
            'created_at' => 'date',
        ]);

        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }
}
