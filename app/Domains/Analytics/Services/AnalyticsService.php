<?php

namespace App\Domains\Analytics\Services;

use App\Domains\Analytics\Models\AnalyticsEvent;
use App\Support\TenantContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnalyticsService
{


public function track(
    string $eventType,
    ?string $entityType = null,
    ?int $entityId = null,
    ?string $source = null,
    ?Request $request = null
): void {

    $tenant = TenantContext::getTenant();

    if (!$tenant) {
        Log::warning('❌ Analytics: No hay tenant');
        return;
    }

    // LOG: Registrar qué está llegando
    Log::info('📊 Analytics track - Datos recibidos:', [
        'eventType' => $eventType,
        'entityType' => $entityType,
        'entityId' => $entityId,
        'source' => $source,
        'tenant_id' => $tenant->id,
        'ip' => $request?->ip(),
        'user_agent' => $request?->userAgent()
    ]);

    // Validación MEJORADA: Si hay entityType pero no entityId, es un error
    // Pero en lugar de return, registramos el error y guardamos igual?
    // Mejor: Si entityType está presente, entityId es OBLIGATORIO
    if ($entityType && !$entityId) {
            Log::warning('⚠️ Analytics: entityType presente pero entityId es null', [
            'eventType' => $eventType,
            'entityType' => $entityType
        ]);
        // NO HACEMOS RETURN - dejamos que intente guardar
        // Así podemos ver qué pasa en la BD
    }

    // Detectar source automáticamente si no se pasa
    if (!$source && $request) {
        $source = $request->query('source', 'direct');
    }

    try {
        $event = AnalyticsEvent::create([
            'tenant_id' => $tenant->id,
            'event_type' => $eventType,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'source' => $source,
            'ip' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);

        Log::info('✅ Analytics track - Evento guardado correctamente', [
            'event_id' => $event->id,
            'entity_type' => $event->entity_type,
            'entity_id' => $event->entity_id
        ]);

        // Limpiar caché del dashboard para este tenant
        \Illuminate\Support\Facades\Cache::forget("dashboard_metrics_{$tenant->id}");

    } catch (\Exception $e) {
        Log::error('❌ Analytics track - Error al guardar:', [
            'error' => $e->getMessage(),
            'data' => [
                'tenant_id' => $tenant->id,
                'event_type' => $eventType,
                'entity_type' => $entityType,
                'entity_id' => $entityId
            ]
        ]);
    }
}
    /**
     * Registrar visita al menú
     */
    public function menuView(?string $source = null, ?Request $request = null): void
    {
        $this->track(
            eventType: 'menu_view',
            entityType: null,
            entityId: null,
            source: $source,
            request: $request
        );
    }

    /**
     * Registrar vista de producto
     */
    public function productView(int $productId, ?string $source = null, ?Request $request = null): void
    {
        $this->track(
            eventType: 'product_view',
            entityType: 'product',
            entityId: $productId,
            source: $source,
            request: $request
        );
    }

    /**
     * Registrar vista de categoría
     */
    public function categoryView(int $categoryId, ?string $source = null, ?Request $request = null): void
    {
        $this->track(
            eventType: 'category_view',
            entityType: 'category',
            entityId: $categoryId,
            source: $source,
            request: $request
        );
    }
}