<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Catalog\Category\Models\Category;
use App\Domains\Catalog\Category\Services\CategoryService;
use App\Support\TenantContext;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $tenant = TenantContext::getTenant();

        $categories = Category::where('tenant_id', $tenant->id)
            ->latest()
            ->get();

        return view('welcome', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->service->create($validated);

        return redirect()->back()->with('success', 'Categoría creada correctamente');
    }

    public function update(Request $request, $subdomain, $categoryId)
    {
        $tenant = TenantContext::getTenant();

        $category = Category::where('tenant_id', $tenant->id)
            ->where('id', $categoryId)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->service->update($category, $validated);

        return redirect()->back()->with('success', 'Categoría actualizada');
    }

    public function destroy($subdomain, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $this->service->delete($category);

        return redirect()->back()->with('success', 'Categoría eliminada');
    }
}