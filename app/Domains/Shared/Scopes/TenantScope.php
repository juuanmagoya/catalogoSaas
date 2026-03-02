<?php

namespace App\Domains\Shared\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Support\TenantContext;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $tenant = TenantContext::getTenant();

        if ($tenant) {
            $builder->where(
                $builder->getModel()->getTable() . '.tenant_id',
                $tenant->id
            );
        }
    }
}