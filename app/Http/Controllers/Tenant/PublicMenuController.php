<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;
use App\Domains\Tenant\Models\Tenant;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    /**
     * Menú público del tenant (por subdominio)
     */
    public function index(Request $request, $subdomain)
    {
        $tenant = TenantContext::getTenant();

        if (!$tenant) {
            abort(404);
        }

        $categories = $this->getCategoriesWithProducts($tenant->id);

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

        $categories = $this->getCategoriesWithProducts($tenant->id);

        return view('menu', [
            'tenant' => $tenant,
            'categories' => $categories
        ]);
    }

    /**
     * Obtener categorías con productos disponibles
     */
    private function getCategoriesWithProducts(int $tenantId)
    {
        return Category::where('tenant_id', $tenantId)
            ->with(['products' => function ($query) {
                $query->where('is_available', true);
            }])
            ->whereHas('products')
            ->orderBy('name')
            ->get();
    }
}