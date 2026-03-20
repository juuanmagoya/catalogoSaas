<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Analytics\Services\AnalyticsService;
use Illuminate\Support\Facades\Log;

class AnalyticsController extends Controller
{
    protected AnalyticsService $analytics;

    public function __construct(AnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    
    /**
     * Registrar eventos desde el frontend (AJAX)
     */

    public function track(Request $request)
    {
        // LOG: Ver todo lo que llega
        Log::info('🔵 AnalyticsController - Request completo:', [
            'all' => $request->all(),
            'headers' => $request->headers->all(),
            'method' => $request->method(),
            'ip' => $request->ip()
        ]);

        $validated = $request->validate([
            'event_type' => 'required|string|in:menu_view,product_view,category_view,search',
            'entity_type' => 'nullable|string|in:product,category',
            'entity_id' => 'nullable|integer',
            'source' => 'nullable|string'
        ]);

        Log::info('🟢 AnalyticsController - Datos validados:', $validated);

        $this->analytics->track(
            eventType: $validated['event_type'],
            entityType: $validated['entity_type'] ?? null,
            entityId: $validated['entity_id'] ?? null,
            source: $validated['source'] ?? null,
            request: $request
        );

        return response()->json([
            'status' => 'ok',
            'message' => 'Evento registrado',
            'received' => $validated
        ]);
    }
}