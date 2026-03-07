<?php

namespace App\Domains\Catalog\Product\Services;

use Illuminate\Support\Str;
use App\Domains\Catalog\Product\Models\Product;
use App\Support\TenantContext;
use App\Domains\Catalog\Category\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductService
{
    public function getAllForCurrentTenant()
    {
        $tenant = TenantContext::getTenant();

        return Product::query()
            ->where('tenant_id', $tenant->id)
            ->with(['category:id,name'])
            ->latest()
            ->paginate(15);
    }

    public function getCategoriesForCurrentTenant()
    {
        $tenant = TenantContext::getTenant();

        return Category::query()
            ->where('tenant_id', $tenant->id)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    }

    public function create(array $data, $image = null): Product
    {
        $tenant = TenantContext::getTenant();

        // 🔒 Validar límite de productos del plan
        $plan = $tenant->plan;

        if ($plan && $plan->max_products !== null) {

            $productsCount = Product::where('tenant_id', $tenant->id)->count();

            if ($productsCount >= $plan->max_products) {
                throw new \Exception(
                    "Has alcanzado el límite de productos de tu plan ({$plan->max_products})."
                );
            }
        }

        // ⚠️ CAMBIO: ahora usamos slug
        $slug = $tenant->slug;

        // 🖼 Procesar imagen optimizada
        if ($image) {

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            // Redimensionar máximo 800px ancho
            $img->scale(width: 800);

            $filename = uniqid() . '.webp';

            // ⚠️ CAMBIO AQUÍ
            $path = "tenants/{$slug}/products/{$filename}";

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

        return Product::create($data);
    }

    public function update(Product $product, array $data, $image = null): Product
    {
        if (isset($data['name']) && $data['name'] !== $product->name) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['name'],
                $product->tenant_id,
                $product->id
            );
        }

        // 🖼 Nueva imagen
        if ($image) {

            $tenant = TenantContext::getTenant();

            // ⚠️ CAMBIO: usar slug
            $slug = $tenant->slug;

            // Eliminar imagen anterior
            if (
                $product->image_path &&
                Storage::disk('public')->exists($product->image_path)
            ) {
                Storage::disk('public')->delete($product->image_path);
            }

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            $img->scale(width: 800);

            $filename = uniqid() . '.webp';

            // ⚠️ CAMBIO AQUÍ
            $path = "tenants/{$slug}/products/{$filename}";

            Storage::disk('public')->put(
                $path,
                (string) $img->toWebp(75)
            );

            $data['image_path'] = $path;
        }

        $product->update($data);

        return $product->fresh();
    }

    public function delete(Product $product): void
    {
        // 🖼 Eliminar imagen si existe
        if (
            $product->image_path &&
            Storage::disk('public')->exists($product->image_path)
        ) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
    }

    protected function generateUniqueSlug(
        string $name,
        int $tenantId,
        ?int $ignoreId = null
    ): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Product::where('tenant_id', $tenantId)
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