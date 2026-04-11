<?php

namespace App\Domains\Tenant\Services;

use App\Domains\Tenant\Models\Tenant;
use App\Support\TenantContext;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;

class TenantSettingsService
{
    /**
     * Crear configuraciones iniciales del tenant
     */
    public function create(array $data, $image = null): Tenant
    {
        $tenant = TenantContext::getTenant();

        $slug = $tenant->slug;

        // 🖼 Procesar logo
        if ($image) {

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            // Redimensionar
            $img->scale(width: 800);

            $filename = uniqid() . '.webp';

            $path = "tenants/{$slug}/logo/{$filename}";

            Storage::disk('public')->put(
                $path,
                (string) $img->toWebp(75)
            );

            $data['logo_path'] = $path;
        }

        $data['tenant_id'] = $tenant->id;

        return Tenant::create($data);
    }

    /**
     * Actualizar configuraciones del tenant
     */
    public function update(Tenant $tenant, array $data, $image = null): Tenant
    {
        $slug = $tenant->slug;

        // 🖼 Si viene nuevo logo
        if ($image) {

            // eliminar logo anterior
            if (
                $tenant->logo_path &&
                Storage::disk('public')->exists($tenant->logo_path)
            ) {
                Storage::disk('public')->delete($tenant->logo_path);
            }

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            $img->scale(width: 800);

            $filename = uniqid() . '.webp';

            $path = "tenants/{$slug}/logo/{$filename}";

            Storage::disk('public')->put(
                $path,
                (string) $img->toWebp(75)
            );

            $data['logo_path'] = $path;
        }

        $tenant->update($data);

        return $tenant->fresh();
    }

    /**
     * Generar QR limpio en PNG (USANDO ENDROID/QR-CODE - SIN IMAGICK)
     */
    private function generateCleanQr(string $url, int $size = 400)
    {
        // Usar la librería endroid/qr-code que funciona con GD
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($url)
            ->size($size)
            ->margin(10)
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->roundBlockSizeMode(RoundBlockSizeMode::Enlarge)
            ->build();
        
        return $result->getString();
    }
    
    /**
     * Incrustar logo en el centro del QR
     */
    private function addLogoToQr(string $qrPng, string $logoPath)
    {
        $manager = new ImageManager(new Driver());
        
        // Cargar QR y logo
        $qrImage = $manager->read($qrPng);
        $fullLogoPath = Storage::disk('public')->path($logoPath);
        
        if (!file_exists($fullLogoPath)) {
            return $qrPng;
        }
        
        $logo = $manager->read($fullLogoPath);
        
        // Calcular tamaño del logo (25% del QR)
        $qrSize = $qrImage->width();
        $logoSize = (int)($qrSize * 0.25);
        
        // Redimensionar logo manteniendo proporción
        $logo->scale(width: $logoSize);
        
        // Centrar el logo en el QR
        $positionX = ($qrSize - $logo->width()) / 2;
        $positionY = ($qrSize - $logo->height()) / 2;
        
        // Pegar logo sobre el QR
        $qrImage->place($logo, 'top-left', $positionX, $positionY);
        
        return (string) $qrImage->toPng();
    }
    
    /**
     * Crear el póster completo con textos y diseño (ESTILO PREMIUM)
     */
    private function createStyledQrPoster(string $qrPng, Tenant $tenant, string $url, array $options = [])
    {
        $manager = new ImageManager(new Driver());
        
        // Configuración del diseño con valores por defecto
        $qrSize = 400;
        $padding = 40;
        
        // Determinar alto total del canvas
        $hasTopText = !empty($options['top_text']);
        $hasBottomUrl = $options['show_url'] ?? true;
        
        $canvasHeight = $qrSize + ($padding * 2);
        
        if ($hasTopText) {
            $canvasHeight += 60; // Espacio para texto superior
        }
        
        if ($hasBottomUrl) {
            $canvasHeight += 80; // Espacio para URL y nombre
        }
        
        // Crear canvas con fondo (color crema/café por defecto)
        $backgroundColor = $options['background_color'] ?? '#f5f0e8';
        $canvas = $manager->create($qrSize + ($padding * 2), $canvasHeight);
        $canvas->fill($backgroundColor);
        
        // Cargar y pegar el QR
        $qr = $manager->read($qrPng);
        $canvas->place($qr, 'top', $padding, $hasTopText ? 60 : $padding);
        
        // Agregar texto superior (ej: "Escanea nuestro menú")
        if ($hasTopText && !empty($options['top_text'])) {
            $this->addTextToImage(
                $canvas,
                $options['top_text'],
                $canvas->width() / 2,
                40,
                $options['top_text_color'] ?? '#6b4226', // Marrón
                $options['top_text_size'] ?? 24,
                'bold'
            );
        }
        
        // Agregar nombre del negocio (debajo del QR)
        $businessName = $tenant->name ?? $tenant->slug;
        $this->addTextToImage(
            $canvas,
            $businessName,
            $canvas->width() / 2,
            $padding + $qrSize + 30,
            $options['business_color'] ?? '#2c1810', // Marrón oscuro
            $options['business_size'] ?? 20,
            'bold'
        );
        
        // Agregar URL debajo del nombre
        if ($hasBottomUrl) {
            $displayUrl = str_replace(['https://', 'http://'], '', $url);
            $this->addTextToImage(
                $canvas,
                $displayUrl,
                $canvas->width() / 2,
                $padding + $qrSize + 60,
                $options['url_color'] ?? '#888888',
                $options['url_size'] ?? 14,
                'normal'
            );
        }
        
        return (string) $canvas->toPng();
    }
    
    /**
     * Agregar texto a una imagen con posición centrada
     */
    private function addTextToImage($image, string $text, int $x, int $y, string $color, int $size, string $weight = 'normal')
    {
        // Buscar fuente disponible
        $fontPath = $this->getFontPath($weight);
        
        if (!$fontPath) {
            // Fallback: no agregar texto si no hay fuente (evita errores)
            return;
        }
        
        $image->text($text, $x, $y, function ($font) use ($fontPath, $color, $size) {
            $font->file($fontPath);
            $font->size($size);
            $font->color($color);
            $font->align('center');
            $font->valign('middle');
        });
    }
    
    /**
     * Obtener ruta de fuente disponible
     */
    private function getFontPath(string $weight = 'normal'): ?string
    {
        // Rutas posibles para fuentes en diferentes sistemas
        $fonts = [
            'bold' => [
                storage_path('fonts/Poppins-Bold.ttf'),
                storage_path('fonts/arialbd.ttf'),
                base_path('public/fonts/Poppins-Bold.ttf'),
                'C:/Windows/Fonts/arialbd.ttf', // Windows
                '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf',
                '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
            ],
            'normal' => [
                storage_path('fonts/Poppins-Regular.ttf'),
                storage_path('fonts/arial.ttf'),
                base_path('public/fonts/Poppins-Regular.ttf'),
                'C:/Windows/Fonts/arial.ttf', // Windows
                '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf',
                '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
            ]
        ];
        
        $searchPaths = $fonts[$weight] ?? $fonts['normal'];
        
        foreach ($searchPaths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }
        
        return null;
    }

    /**
     * Generar QR PREMIUM con diseño completo (NUEVA FUNCIONALIDAD)
     * Esto recrea el diseño de la imagen que compartiste
     */
    public function generatePremiumQr(Tenant $tenant, array $options = [])
    {
        $url = config('app.url') . '/' . $tenant->slug;
        
        // 1. Generar el QR puro (sin logo primero)
        $qrSize = $options['qr_size'] ?? 400;
        $qrPng = $this->generateCleanQr($url, $qrSize);
        
        // 2. Si tiene logo y se solicita, incrustarlo en el QR
        if ($tenant->logo_path && ($options['with_logo'] ?? true)) {
            $qrPng = $this->addLogoToQr($qrPng, $tenant->logo_path);
        }
        
        // 3. Crear el diseño completo (fondo + QR + textos)
        $finalImage = $this->createStyledQrPoster($qrPng, $tenant, $url, $options);
        
        return $finalImage;
    }
}