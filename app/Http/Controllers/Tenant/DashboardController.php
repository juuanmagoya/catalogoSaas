<?php
// app/Http/Controllers/Tenant/DashboardController.php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Domains\Analytics\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Mostrar dashboard principal
     */
    public function index(Request $request)
    {
        $metrics = $this->dashboardService->getDashboardMetrics();
        
        // Si es una petición AJAX, devolver solo los datos actualizados
        if ($request->ajax()) {
            return response()->json($metrics);
        }

        return view('tenant.admin.dashboard', compact('metrics'));
    }

    /**
     * Refrescar métricas (para auto-refresh)
     */
    public function refresh()
    {
        // Limpiar cache y obtener métricas frescas
        $tenant = \App\Support\TenantContext::getTenant();
        \Illuminate\Support\Facades\Cache::forget("dashboard_metrics_{$tenant->id}");
        
        $metrics = $this->dashboardService->getDashboardMetrics();
        
        return response()->json($metrics);
    }
}