<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\TenantContext;
use App\Domains\Tenant\Services\TenantSettingsService;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    /**
 * Mostrar la página de configuración
 */
    public function edit()
    {
        $tenant = TenantContext::getTenant();
        
        // Generar vista previa del QR premium automáticamente
        try {
            $qrPng = $this->settingsService->generatePremiumQr($tenant, [
                'qr_size' => 250,
                'with_logo' => true,
                'top_text' => 'Escanea nuestro menú',
                'top_text_color' => '#6b4226',
                'top_text_size' => 16,
                'business_color' => '#2c1810',
                'business_size' => 14,
                'url_color' => '#888888',
                'url_size' => 10,
                'show_url' => true,
                'background_color' => '#f5f0e8',
            ]);
            
            $premiumQrBase64 = base64_encode($qrPng);
        } catch (\Exception $e) {
            // Si hay error, no mostrar preview
            $premiumQrBase64 = null;
        }
        
        return view('tenant.settings.edit', compact('tenant', 'premiumQrBase64'));
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

    /**
     * Generar QR normal (PLAN BÁSICO)
     */
    public function generateQr()
    {
        $tenant = TenantContext::getTenant();

        $url = config('app.url') . '/' . $tenant->slug;

        $qrCode = QrCode::format('svg')
            ->size(300)
            ->margin(1)
            ->generate($url);

        return view('tenant.settings.edit', compact('tenant', 'qrCode'));
    }

    /**
     * Generar QR PREMIUM con diseño completo (NUEVO MÉTODO)
     * Este genera el QR estilo "Escanea nuestro menú" con logo centrado
     */
    public function generatePremiumQr()
    {
        $tenant = TenantContext::getTenant();
        
        // Generar el QR con el diseño premium
        $qrPng = $this->settingsService->generatePremiumQr($tenant, [
            'qr_size' => 400,
            'with_logo' => true,
            'top_text' => 'Escanea nuestro menú',
            'top_text_color' => '#6b4226', // Marrón
            'top_text_size' => 24,
            'business_color' => '#2c1810',
            'business_size' => 20,
            'url_color' => '#888888',
            'url_size' => 14,
            'show_url' => true,
            'background_color' => '#f5f0e8', // Fondo crema
        ]);
        
        // Devolver como descarga
        return response($qrPng)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="'.$tenant->slug.'_premium_qr.png"');
    }

    /**
     * Vista previa del QR Premium (para mostrar en el panel)
     */
    public function previewPremiumQr()
    {
        $tenant = TenantContext::getTenant();
        
        // Generar una versión más pequeña para vista previa
        $qrPng = $this->settingsService->generatePremiumQr($tenant, [
            'qr_size' => 300,
            'with_logo' => true,
            'top_text' => 'Escanea nuestro menú',
            'top_text_color' => '#6b4226',
            'top_text_size' => 20,
            'business_color' => '#2c1810',
            'business_size' => 16,
            'url_color' => '#888888',
            'url_size' => 12,
            'show_url' => true,
            'background_color' => '#f5f0e8',
        ]);
        
        $qrBase64 = base64_encode($qrPng);
        
        // Puedes retornar una vista específica o el JSON
        if (request()->wantsJson()) {
            return response()->json(['qr_image' => $qrBase64]);
        }
        
        // O mostrar en una vista
        return view('tenant.settings.premium-qr-preview', compact('tenant', 'qrBase64'));
    }

    /**
     * Descargar QR SVG (funcionalidad existente)
     */
    public function downloadQrImage()
    {
        $tenant = TenantContext::getTenant();

        $url = config('app.url') . '/' . $tenant->slug;

        $qrImage = QrCode::format('svg')
            ->size(400)
            ->margin(2)
            ->generate($url);

        return response($qrImage)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="'.$tenant->slug.'_qr.svg"');
    }

    /**
     * Poster imprimible (funcionalidad existente)
     */
    public function downloadQrPoster()
    {
        $tenant = TenantContext::getTenant();

        $url = config('app.url') . '/' . $tenant->slug;

        $qrCode = QrCode::format('svg')
            ->size(350)
            ->generate($url);

        return view('tenant.settings.qr-poster', [
            'tenant' => $tenant,
            'qrCode' => $qrCode,
            'url' => $url
        ]);
    }
}