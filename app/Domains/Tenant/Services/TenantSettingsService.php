<?php

namespace App\Domains\Tenant\Services;

use App\Domains\Tenant\Models\Tenant;
use App\Support\TenantContext;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TenantSettingsService
{
    /**
     * Crear configuraciones iniciales del tenant
     */
    public function create(array $data, $image = null): Tenant
    {
        $tenant = TenantContext::getTenant();

        $slug = $tenant->slug;

        // 🖼 Procesar logo
        if ($image) {

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            // Redimensionar
            $img->scale(width: 800);

            $filename = uniqid() . '.webp';

            $path = "tenants/{$slug}/logo/{$filename}";

            Storage::disk('public')->put(
                $path,
                (string) $img->toWebp(75)
            );

            $data['logo_path'] = $path;
        }

        $data['tenant_id'] = $tenant->id;

        return Tenant::create($data);
    }

    /**
     * Actualizar configuraciones del tenant
     */
    public function update(Tenant $tenant, array $data, $image = null): Tenant
    {
        $slug = $tenant->slug;

        // 🖼 Si viene nuevo logo
        if ($image) {

            // eliminar logo anterior
            if (
                $tenant->logo_path &&
                Storage::disk('public')->exists($tenant->logo_path)
            ) {
                Storage::disk('public')->delete($tenant->logo_path);
            }

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            $img->scale(width: 800);

            $filename = uniqid() . '.webp';

            $path = "tenants/{$slug}/logo/{$filename}";

            Storage::disk('public')->put(
                $path,
                (string) $img->toWebp(75)
            );

            $data['logo_path'] = $path;
        }

        $tenant->update($data);

        return $tenant->fresh();
    }
}