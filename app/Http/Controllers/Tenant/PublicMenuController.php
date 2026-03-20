<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Analytics\Services\AnalyticsService;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    protected AnalyticsService $analytics;

    public function __construct(AnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    /**
     * Menú público del tenant
     */
    public function index(Request $request, $subdomain)
    {
        $tenant = TenantContext::getTenant();

        if (!$tenant) {
            abort(404);
        }

        // Registrar visita al menú
        $this->analytics->menuView(
            source: $request->query('source'),
            request: $request
        );

        $categories = Category::where('tenant_id', $tenant->id)
            ->with(['products' => function ($query) {
                $query->where('is_available', true);
            }])
            ->whereHas('products')
            ->orderBy('name')
            ->get();

        return view('tenant.public.menu', [
            'categories' => $categories,
            'tenant' => $tenant
        ]);
    }

    /**
     * Mostrar menú por slug
     */
    public function show(Request $request, $slug)
    {
        $tenant = Tenant::where('slug', $slug)->firstOrFail();

        // Registrar visita al menú
        $this->analytics->menuView(
            source: $request->query('source'),
            request: $request
        );

        $categories = Category::where('tenant_id', $tenant->id)
            ->with(['products' => function ($query) {
                $query->where('is_available', true);
            }])
            ->whereHas('products')
            ->orderBy('name')
            ->get();

        return view('menu', [
            'tenant' => $tenant,
            'categories' => $categories
        ]);
    }
}