<?php

namespace App\Support;

use App\Domains\Tenant\Models\Tenant;

class TenantContext
{
    protected static ?Tenant $tenant = null;

    public static function setTenant(Tenant $tenant): void
    {
        self::$tenant = $tenant;
    }

    public static function getTenant(): ?Tenant
    {
        return self::$tenant;
    }

    public static function id(): ?int
    {
        return self::$tenant?->id;
    }

    public static function hasTenant(): bool
    {
        return self::$tenant !== null;
    }

    public static function clear(): void
    {
        self::$tenant = null;
    }
}