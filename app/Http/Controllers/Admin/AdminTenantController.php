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
        $tenants = $this->tenantService->getAll();

        $plans = Plan::all();

        return view('admin.tenant.index', compact('tenants','plans'));
    }

    /**
     * Guardar tenant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],

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
     * Actualizar tenant
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],

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