<?php

namespace App\Domains\Tenant\Services;

use Illuminate\Support\Str;
use App\Domains\Tenant\Models\Tenant;

class TenantService
{
    /**
     * Obtener todos los tenants
     */
    public function getAll()
    {
        return Tenant::query()
            ->with('plan')
            ->withCount('products')
            ->latest()
            ->paginate(15);
    }

    /**
     * Crear tenant
     */
    public function create(array $data): Tenant
    {
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        return Tenant::create($data);
    }

    /**
     * Actualizar tenant
     */
    public function update(Tenant $tenant, array $data): Tenant
    {
        if (isset($data['name']) && $data['name'] !== $tenant->name) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['name'],
                $tenant->id
            );
        }

        $tenant->update($data);

        return $tenant->fresh();
    }

    /**
     * Eliminar tenant
     */
    public function delete(Tenant $tenant): void
    {
        $tenant->delete();
    }

    /**
     * Generar slug único
     */
    protected function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {

        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Tenant::where('slug', $slug)
                ->when($ignoreId, fn ($query) =>
                    $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }
}