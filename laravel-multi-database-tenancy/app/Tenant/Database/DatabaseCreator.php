<?php

namespace App\Tenant\Database;

use App\Tenant\Models\Tenant;
use Illuminate\Support\Facades\DB;

class DatabaseCreator
{
    public function create(Tenant $tenant)
    {
        return DB::statement("
            CREATE DATABASE fresh_{$tenant->id}
        ");
    }
}
