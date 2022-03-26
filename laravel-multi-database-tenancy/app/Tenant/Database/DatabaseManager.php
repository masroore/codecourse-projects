<?php

namespace App\Tenant\Database;

use App\Tenant\Models\Tenant;
use Illuminate\Database\DatabaseManager as BaseDatabaseManager;

class DatabaseManager
{
    protected $db;

    public function __construct(BaseDatabaseManager $db)
    {
        $this->db = $db;
    }

    public function createConnection(Tenant $tenant)
    {
        config()->set('database.connections.tenant', $this->getTenantConnection($tenant));
    }

    public function connectToTenant()
    {
        $this->db->reconnect('tenant');
    }

    public function purge()
    {
        $this->db->purge('tenant');
    }

    public function getDefaultConnectionName()
    {
        return config('database.default');
    }

    protected function getTenantConnection(Tenant $tenant)
    {
        return array_merge(
            config()->get($this->getConfigConnectionPath()),
            $tenant->tenantConnection->only('database')
        );
    }

    protected function getConfigConnectionPath()
    {
        return sprintf('database.connections.%s', $this->getDefaultConnectionName());
    }
}
