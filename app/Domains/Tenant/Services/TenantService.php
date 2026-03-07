<?php

namespace App\Domains\Tenant\Services;

use App\Domains\Tenant\Models\Tenant;
use Illuminate\Support\Facades\DB;

class TenantService
{
    /**
     * Crear un tenant
     */
    public function create(array $data): Tenant
    {
        return DB::transaction(function () use ($data) {

            $tenant = Tenant::create([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'plan_id' => $data['plan_id'],
                'status' => $data['status'],
            ]);

            return $tenant;

        });
    }

    /**
     * Actualizar tenant
     */
    public function update(Tenant $tenant, array $data): Tenant
    {
        return DB::transaction(function () use ($tenant, $data) {

            $tenant->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'plan_id' => $data['plan_id'],
                'status' => $data['status'],
            ]);

            return $tenant;

        });
    }

    /**
     * Eliminar tenant
     */
    public function delete(Tenant $tenant): void
    {
        DB::transaction(function () use ($tenant) {

            $tenant->delete();

        });
    }
}