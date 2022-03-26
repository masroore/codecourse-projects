<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantDatabaseCreated;
use App\Tenant\Models\Tenant;
use Illuminate\Support\Facades\Artisan;

class SetUpTenantDatabase
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(TenantDatabaseCreated $event)
    {
        if ($this->migrate($event->tenant)) {
            $this->seed($event->tenant);
        }
    }

    protected function migrate(Tenant $tenant)
    {
        $migration = Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->id],
        ]);

        return 0 === $migration;
    }

    protected function seed(Tenant $tenant)
    {
        return Artisan::call('tenants:seed', [
            '--tenants' => [$tenant->id],
        ]);
    }
}
