<?php
// app/Http/Controllers/Tenant/DashboardController.php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Domains\Catalog\Product\Models\Product;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tenant = TenantContext::getTenant();
        
        $data = [
            'productsCount' => Product::where('tenant_id', $tenant->id)->count(),
            'categoriesCount' => Category::where('tenant_id', $tenant->id)->count(),
            'tenantName' => $tenant->name,
            'userName' => Auth::user()->name ?? 'Usuario',
        ];

        return view('tenant.admin.dashboard', compact('data'));
    }
}