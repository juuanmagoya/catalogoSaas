<?php

namespace App\Domains\Catalog\Category\Services;

use Illuminate\Support\Str;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
    public function create(array $data, $image = null): Category
    {
        $tenant = TenantContext::getTenant();

        // 🖼 Procesar imagen optimizada
        if ($image) {

            $subdomain = $tenant->subdomain;

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            // 🔥 Redimensionar manteniendo proporción (máx 800px ancho)
            $img->scale(width: 800);

            // Generar nombre único en webp
            $filename = uniqid() . '.webp';
            $path = "tenants/{$subdomain}/categories/{$filename}";

            // Guardar optimizada (calidad 75)
            Storage::disk('public')->put(
                $path,
                (string) $img->toWebp(75)
            );

            $data['image_path'] = $path;
        }

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
    public function update(Category $category, array $data, $image = null): Category
    {
        if (isset($data['name']) && $data['name'] !== $category->name) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['name'],
                $category->tenant_id,
                $category->id
            );
        }

        // 🖼 Si viene nueva imagen
        if ($image) {

            $tenant = TenantContext::getTenant();
            $subdomain = $tenant->subdomain;

            // 🔥 Eliminar imagen anterior si existe
            if ($category->image_path && Storage::disk('public')->exists($category->image_path)) {
                Storage::disk('public')->delete($category->image_path);
            }

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            // 🔥 Redimensionar manteniendo proporción
            $img->scale(width: 800);

            $filename = uniqid() . '.webp';
            $path = "tenants/{$subdomain}/categories/{$filename}";

            Storage::disk('public')->put(
                $path,
                (string) $img->toWebp(75)
            );

            $data['image_path'] = $path;
        }

        $category->update($data);

        return $category->fresh();
    }

    /**
     * Eliminar categoría
     */
    public function delete(Category $category): void
    {
        // 🖼 Si tiene imagen, eliminarla del storage
        if ($category->image_path && Storage::disk('public')->exists($category->image_path)) {
            Storage::disk('public')->delete($category->image_path);
        }

        // 🗑 Eliminar registro
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