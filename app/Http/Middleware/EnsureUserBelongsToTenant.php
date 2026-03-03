<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Support\TenantContext;

class EnsureUserBelongsToTenant
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = TenantContext::getTenant();

        if (!$request->user() || $request->user()->tenant_id !== $tenant->id) {
            abort(403, 'No autorizado para este tenant.');
        }

        return $next($request);
    }
}