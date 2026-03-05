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
        // 🔥 Toda la lógica vive en el Service
        $products = $this->service->getAllForCurrentTenant();
        $categories = $this->service->getCategoriesForCurrentTenant();

        return view('tenant.admin.products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $tenant = TenantContext::getTenant();

        $validated = $request->validate([
            'category_id' => [
                'required',
                function ($attribute, $value, $fail) use ($tenant) {
                    $exists = Category::where('tenant_id', $tenant->id)
                        ->where('id', $value)
                        ->exists();

                    if (!$exists) {
                        $fail('La categoría no es válida.');
                    }
                }
            ],
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'nullable|numeric|min:0',
            'is_available' => 'required|boolean',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['tenant_id'] = $tenant->id;
        $validated['is_available'] = $request->boolean('is_available');

        $this->service->create(
            $validated,
            $request->file('image')
        );

        return redirect()->back()
            ->with('success', 'Producto creado correctamente');
    }

    public function update(Request $request, $subdomain, $productId)
    {
        $tenant = TenantContext::getTenant();

        $product = Product::where('tenant_id', $tenant->id)
            ->where('id', $productId)
            ->firstOrFail();

        $validated = $request->validate([
            'category_id' => [
                'required',
                function ($attribute, $value, $fail) use ($tenant) {
                    $exists = Category::where('tenant_id', $tenant->id)
                        ->where('id', $value)
                        ->exists();

                    if (!$exists) {
                        $fail('La categoría no es válida.');
                    }
                }
            ],
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'nullable|numeric|min:0',
            'is_available' => 'required|in:0,1',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_available'] = $request->boolean('is_available');

        $this->service->update(
            $product,
            $validated,
            $request->file('image')
        );

        return redirect()->back()
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($subdomain, $productId)
    {
        $tenant = TenantContext::getTenant();

        $product = Product::where('tenant_id', $tenant->id)
            ->where('id', $productId)
            ->firstOrFail();

        $this->service->delete($product);

        return redirect()->back()->with('success', 'Producto eliminado correctamente');
    }
}