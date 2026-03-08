<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\TenantContext;
use App\Domains\Tenant\Services\TenantSettingsService;

class TenantSettingsController extends Controller
{
    protected TenantSettingsService $settingsService;

    public function __construct(TenantSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Mostrar la página de configuración
     */
    public function edit()
    {
        $tenant = TenantContext::getTenant();

        return view('tenant.settings.edit', compact('tenant'));
    }

    /**
     * Actualizar configuraciones del tenant
     */
    public function update(Request $request)
    {
        $tenant = TenantContext::getTenant();

        $validated = $request->validate([
            'whatsapp_number' => 'nullable|string|max:20',
            'whatsapp_message' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:100',
            'facebook' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $this->settingsService->update(
            $tenant,
            $validated,
            $request->file('logo')
        );

        return redirect()
            ->back()
            ->with('success', 'Configuración actualizada correctamente.');
    }
}