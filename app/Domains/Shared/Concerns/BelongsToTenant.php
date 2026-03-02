<?php

namespace App\Domains\Shared\Concerns;

use App\Domains\Shared\Scopes\TenantScope;
use App\Support\TenantContext;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant(): void
    {
        // Aplica el Global Scope automáticamente
        static::addGlobalScope(new TenantScope);

        // Asigna tenant_id automáticamente al crear
        static::creating(function ($model) {
            if ($tenant = TenantContext::getTenant()) {
                $model->tenant_id = $tenant->id;
            }
        });
    }
}