<?php

namespace App\Domains\Analytics\Services;

use App\Domains\Analytics\Models\AnalyticsEvent;
use App\Domains\Catalog\Product\Models\Product;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    /**
     * Obtener métricas del dashboard con cache
     */
    public function getDashboardMetrics(): array
    {
        $tenant = TenantContext::getTenant();

        return Cache::remember(
            "dashboard_metrics_{$tenant->id}",
            60,
            fn() => $this->buildMetrics($tenant->id)
        );
    }

    /**
     * Construcción centralizada de métricas
     */
    private function buildMetrics(int $tenantId): array
    {
        return [

            // Cards principales
            'productsCount'   => $this->productsCount($tenantId),
            'categoriesCount' => $this->categoriesCount($tenantId),
            'menuViews'       => $this->menuViews($tenantId),
            'qrScans'         => $this->qrScans($tenantId),

            // Métricas de uso
            'visitsStats' => $this->visitsStats($tenantId),

            // Origen de tráfico
            'trafficSources' => $this->trafficSources($tenantId),

            // Rankings
            'topProducts'   => $this->topProducts($tenantId),
            'topCategories' => $this->topCategories($tenantId),

            // Engagement
            'interactionRate' => $this->interactionRate($tenantId),

            // Gráfico
            'visitsByDay' => $this->visitsByDay($tenantId),
        ];
    }

    /**
     * Cantidad de productos
     */
    private function productsCount(int $tenantId): int
    {
        return Product::where('tenant_id', $tenantId)->count();
    }

    /**
     * Cantidad de categorías
     */
    private function categoriesCount(int $tenantId): int
    {
        return Category::where('tenant_id', $tenantId)->count();
    }

    /**
     * Total visitas menú
     */
    private function menuViews(int $tenantId): int
    {
        return AnalyticsEvent::where('tenant_id', $tenantId)
            ->where('event_type', 'menu_view')
            ->count();
    }

    /**
     * Escaneos QR
     */
    private function qrScans(int $tenantId): int
    {
        return AnalyticsEvent::where('tenant_id', $tenantId)
            ->where('event_type', 'menu_view')
            ->where('source', 'qr')
            ->count();
    }

    /**
     * Visitas hoy / semana / mes
     * OPTIMIZADO: una sola query
     */
    private function visitsStats(int $tenantId): array
    {
        $today = Carbon::today();
        $startWeek = Carbon::now()->startOfWeek();
        $startMonth = Carbon::now()->startOfMonth();

        $stats = AnalyticsEvent::selectRaw("
                COUNT(CASE WHEN created_at >= ? THEN 1 END) as today,
                COUNT(CASE WHEN created_at >= ? THEN 1 END) as week,
                COUNT(CASE WHEN created_at >= ? THEN 1 END) as month
            ", [
                $today,
                $startWeek,
                $startMonth
            ])
            ->where('tenant_id', $tenantId)
            ->where('event_type', 'menu_view')
            ->first();

        return [
            'today' => (int) $stats->today,
            'week'  => (int) $stats->week,
            'month' => (int) $stats->month,
        ];
    }

    /**
     * Origen del tráfico
     */
    private function trafficSources(int $tenantId)
    {
        return AnalyticsEvent::select(
                'source',
                DB::raw('COUNT(*) as total')
            )
            ->where('tenant_id', $tenantId)
            ->where('event_type', 'menu_view')
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();
    }

    /**
     * Productos más vistos
     * JOIN para traer nombre del producto
     */
    private function topProducts(int $tenantId)
    {
        return AnalyticsEvent::select(
                'products.id',
                'products.name',
                DB::raw('COUNT(*) as views')
            )
            ->join('products', 'products.id', '=', 'analytics_events.entity_id')
            ->where('analytics_events.tenant_id', $tenantId)
            ->where('analytics_events.event_type', 'product_view')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('views')
            ->limit(5)
            ->get();
    }

    /**
     * Categorías más visitadas
     */
    private function topCategories(int $tenantId)
    {
        return AnalyticsEvent::select(
                'categories.id',
                'categories.name',
                DB::raw('COUNT(*) as views')
            )
            ->join('categories', 'categories.id', '=', 'analytics_events.entity_id')
            ->where('analytics_events.tenant_id', $tenantId)
            ->where('analytics_events.event_type', 'category_view')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('views')
            ->limit(5)
            ->get();
    }

    /**
     * Tasa de interacción
     * OPTIMIZADO: una sola query
     */
    private function interactionRate(int $tenantId): float
    {
        $stats = AnalyticsEvent::selectRaw("
                COUNT(CASE WHEN event_type = 'menu_view' THEN 1 END) as menu_views,
                COUNT(CASE WHEN event_type = 'product_view' THEN 1 END) as product_views
            ")
            ->where('tenant_id', $tenantId)
            ->first();

        if ($stats->menu_views == 0) {
            return 0;
        }

        return round(($stats->product_views / $stats->menu_views) * 100, 2);
    }

    /**
     * Visitas por día (últimos 7 días)
     */
    private function visitsByDay(int $tenantId)
    {
        return AnalyticsEvent::selectRaw("
                DATE(created_at) as date,
                COUNT(*) as visits
            ")
            ->where('tenant_id', $tenantId)
            ->where('event_type', 'menu_view')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->get();
    }
}