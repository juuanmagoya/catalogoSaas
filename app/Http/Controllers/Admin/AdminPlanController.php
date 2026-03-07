<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Plan\Models\Plan;
use App\Domains\Plan\Services\PlanService;

class AdminPlanController extends Controller
{
    protected PlanService $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    /**
     * Listar planes
     */
    public function index()
    {
        $plans = Plan::withCount('tenants')
            ->latest()
            ->paginate(10);

        return view('admin.plan.index', compact('plans'));
    }

    /**
     * Formulario crear plan
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Guardar plan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'price' => ['required','numeric','min:0'],
            'duration_days' => ['required','integer','min:1'],
            'max_products' => ['nullable','integer','min:1'],
        ]);

        $this->planService->create($validated);

        return redirect()
            ->route('admin.plans.index')
            ->with('success', 'Plan creado correctamente.');
    }

    /**
     * Mostrar plan
     */
    public function show(Plan $plan)
    {
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Formulario editar
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Actualizar plan
     */
    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'price' => ['required','numeric','min:0'],
            'duration_days' => ['required','integer','min:1'],
            'max_products' => ['nullable','integer','min:1'],
        ]);

        $this->planService->update($plan, $validated);

        return redirect()
            ->route('admin.plans.index')
            ->with('success', 'Plan actualizado correctamente.');
    }

    /**
     * Eliminar plan
     */
    public function destroy(Plan $plan)
    {
        if ($plan->tenants()->exists()) {
        return back()->with('error', 'No se puede eliminar un plan que tiene tenants asociados.');
}
        $this->planService->delete($plan);

        return redirect()
            ->route('admin.plans.index')
            ->with('success', 'Plan eliminado correctamente.');
    }
}