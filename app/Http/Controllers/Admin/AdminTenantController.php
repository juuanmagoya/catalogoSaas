<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Tenant\Services\TenantService;
use App\Domains\Plan\Models\Plan;

class AdminTenantController extends Controller
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     * Listar tenants
     */
    public function index()
    {
        $tenants = Tenant::with('plan')
            ->latest()
            ->paginate(15);

        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        $plans = Plan::pluck('name', 'id');

        return view('admin.tenants.create', compact('plans'));
    }

    /**
     * Guardar tenant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],

            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                'unique:tenants,slug'
            ],

            'plan_id' => [
                'required',
                'exists:plans,id'
            ],

            'status' => [
                'required',
                Rule::in(['trial','active','suspended','expired'])
            ],
        ]);

        $this->tenantService->create($validated);

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant creado correctamente.');
    }

    /**
     * Mostrar tenant
     */
    public function show(Tenant $tenant)
    {
        $tenant->load('plan');

        return view('admin.tenants.show', compact('tenant'));
    }

    /**
     * Formulario editar
     */
    public function edit(Tenant $tenant)
    {
        $plans = Plan::pluck('name', 'id');

        return view('admin.tenants.edit', compact('tenant','plans'));
    }

    /**
     * Actualizar tenant
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],

            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('tenants','slug')->ignore($tenant->id)
            ],

            'plan_id' => [
                'required',
                'exists:plans,id'
            ],

            'status' => [
                'required',
                Rule::in(['trial','active','suspended','expired'])
            ],
        ]);

        $this->tenantService->update($tenant, $validated);

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant actualizado correctamente.');
    }

    /**
     * Eliminar tenant
     */
    public function destroy(Tenant $tenant)
    {
        $this->tenantService->delete($tenant);

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant eliminado correctamente.');
    }
}