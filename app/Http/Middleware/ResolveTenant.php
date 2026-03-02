<?php

namespace App\Http\Middleware;

use Closure;
use App\Domains\Tenant\Models\Tenant;
use App\Support\TenantContext;

class ResolveTenant
{
    public function handle($request, Closure $next)
    {
        $subdomain = $request->route('subdomain');

        $tenant = Tenant::where('subdomain', $subdomain)
            ->where('status', 'active')
            ->first();

        if (!$tenant) {
            abort(404, 'Tenant no encontrado');
        }

        TenantContext::setTenant($tenant);

        return $next($request);
    }
}