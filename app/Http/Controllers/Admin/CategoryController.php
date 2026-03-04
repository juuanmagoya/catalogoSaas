<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Catalog\Category\Services\CategoryService;
use App\Domains\Catalog\Category\Models\Category;
use App\Support\TenantContext;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Listado de categorías del tenant actual
     */
    public function index()
    {
        $categories = $this->service->getAllForCurrentTenant();

        return view('tenant.admin.categories.index', compact('categories'));
    }

    /**
     * Crear categoría
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $this->service->create(
            $validated,
            $request->file('image')
        );

        return redirect()->back()
            ->with('success', 'Categoría creada correctamente');
    }

    /**
     * Actualizar categoría
     */
    public function update(Request $request, $subdomain, $categoryId)
    {
        $tenant = TenantContext::getTenant();

        $category = Category::where('tenant_id', $tenant->id)
            ->where('id', $categoryId)
            ->firstOrFail();

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'required|in:0,1',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $this->service->update(
            $category,
            $validated,
            $request->file('image')
        );

        return redirect()->back()
            ->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Eliminar categoría (aislado por tenant)
     */
    public function destroy($subdomain, $categoryId)
    {
        $tenant = TenantContext::getTenant();

        $category = Category::where('tenant_id', $tenant->id)
            ->where('id', $categoryId)
            ->firstOrFail();

        $this->service->delete($category);

        return redirect()->back()
            ->with('success', 'Categoría eliminada correctamente');
    }
}