<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Catalog\Product\Models\Product;
use App\Domains\Catalog\Product\Services\ProductService;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;

class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $tenant = TenantContext::getTenant();

        $products = Product::where('tenant_id', $tenant->id)
            ->with('category')
            ->latest()
            ->get();

        $categories = Category::where('tenant_id', $tenant->id)->get();

        return view('welcome', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $tenant = TenantContext::getTenant();

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
        ]);

        // Seguridad extra multi-tenant:
        Category::where('tenant_id', $tenant->id)
            ->where('id', $validated['category_id'])
            ->firstOrFail();

        $this->service->create($validated);

        return redirect()->back()->with('success', 'Producto creado correctamente');
    }

    public function update(Request $request, $subdomain, $productId)
    {
        $tenant = TenantContext::getTenant();

        $product = Product::where('tenant_id', $tenant->id)
            ->where('id', $productId)
            ->firstOrFail();

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'is_available' => 'boolean',
        ]);

        $this->service->update($product, $validated);

        return redirect()->back()->with('success', 'Producto actualizado');
    }

    public function destroy($subdomain, $productId)
    {
        $tenant = TenantContext::getTenant();

        $product = Product::where('tenant_id', $tenant->id)
            ->where('id', $productId)
            ->firstOrFail();

        $this->service->delete($product);

        return redirect()->back()->with('success', 'Producto eliminado');
    }
}