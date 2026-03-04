<?php

namespace App\Domains\Catalog\Category\Services;

use Illuminate\Support\Str;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;


class CategoryService
{
    /**
     * Obtener todas las categorías del tenant actual
     */
    public function getAllForCurrentTenant()
    {
        $tenant = TenantContext::getTenant();

        return Category::query()
            ->where('tenant_id', $tenant->id)
            ->withCount('products')
            ->latest()
            ->paginate(15);
    }

    /**
     * Crear categoría
     */
    public function create(array $data): Category
    {
        $tenant = TenantContext::getTenant();

        $data['tenant_id'] = $tenant->id;

        $data['slug'] = $this->generateUniqueSlug(
            $data['name'],
            $tenant->id
        );

        return Category::create($data);
    }

    /**
     * Actualizar categoría
     */
    public function update(Category $category, array $data): Category
    {
        if (isset($data['name']) && $data['name'] !== $category->name) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['name'],
                $category->tenant_id,
                $category->id
            );
        }

        $category->update($data);

        return $category->fresh();
    }

    /**
     * Eliminar categoría
     */
    public function delete(Category $category): void
    {
        $category->delete();
    }

    /**
     * Generar slug único por tenant
     */
    protected function generateUniqueSlug(
        string $name,
        int $tenantId,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Category::where('tenant_id', $tenantId)
                ->where('slug', $slug)
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