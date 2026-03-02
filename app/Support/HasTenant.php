<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

trait HasTenant
{
    protected static function bootHasTenant()
    {
        // Global Scope
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (TenantContext::hasTenant()) {
                $builder->where('tenant_id', TenantContext::id());
            }
        });

        // Auto-assign tenant_id on create
        static::creating(function (Model $model) {
            if (TenantContext::hasTenant() && empty($model->tenant_id)) {
                $model->tenant_id = TenantContext::id();
            }
        });
    }
}