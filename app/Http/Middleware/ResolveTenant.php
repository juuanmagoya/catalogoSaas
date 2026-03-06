<?php

namespace App\Http\Middleware;

use Closure;
use App\Domains\Tenant\Models\Tenant;
use App\Support\TenantContext;
use Illuminate\Http\Request;

class ResolveTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtener el slug del tenant desde la ruta
        $slug = $this->getTenantSlugFromRoute($request);
        
        if (!$slug) {
            abort(404, 'Identificador de negocio no proporcionado');
        }

        // Buscar tenant activo por slug
        $tenant = Tenant::query()
            ->where('slug', $slug)
            ->where('status', 'active')
            ->first();

        if (!$tenant) {
            abort(404, 'El negocio que buscas no existe o no está disponible');
        }

        // Verificar si el tenant tiene acceso (plan vigente, etc.)
        if (!$this->checkTenantAccess($tenant)) {
            abort(403, 'El negocio no tiene acceso en este momento');
        }

        // Guardar tenant en el contexto para toda la aplicación
        TenantContext::setTenant($tenant);
        
        // También podrías compartirlo con todas las vistas
        view()->share('currentTenant', $tenant);

        return $next($request);
    }

    /**
     * Extrae el slug del tenant de la ruta actual
     */
    private function getTenantSlugFromRoute(Request $request): ?string
    {
        $route = $request->route();
        
        if (!$route) {
            return null;
        }

        // El parámetro se llama 'tenant' por la definición en web.php: {tenant:slug}
        $slug = $route->parameter('tenant');
        
        // Si es un modelo (por si acaso), obtenemos el slug
        if (is_object($slug) && method_exists($slug, 'getAttribute')) {
            return $slug->getAttribute('slug');
        }
        
        // Si es un string, lo devolvemos directamente
        return is_string($slug) ? $slug : null;
    }

    /**
     * Verifica si el tenant tiene acceso (plan activo, etc.)
     */
    private function checkTenantAccess(Tenant $tenant): bool
    {
        // Aquí puedes agregar lógica adicional:
        // - Verificar si el plan está vigente
        // - Verificar si no está suspendido
        // - Verificar límites, etc.
        
        return true; // Por ahora siempre true
    }
}