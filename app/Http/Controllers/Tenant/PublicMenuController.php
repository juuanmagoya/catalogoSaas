<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;
use App\Domains\Tenant\Models\Tenant;

class PublicMenuController extends Controller
{
    public function index($subdomain)
    {
        $tenant = TenantContext::getTenant();

        $categories =  Category::where('tenant_id', $tenant->id)
            ->with(['products' => function ($query) {
                $query->where('is_available', true);
            }])
            ->whereHas('products')
            ->orderBy('name')
            ->get();

        return view('tenant.public.menu', compact('categories', 'tenant'));
    }
    public function show($slug)
    {
        $tenant = Tenant::where('slug', $slug)->firstOrFail();

        $categories = Category::where('tenant_id', $tenant->id)
            ->with(['products' => function ($query) {
                $query->where('active', 1);
            }])
            ->get();

        return view('menu', compact('tenant', 'categories'));
    }
}