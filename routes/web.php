<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Tenant\PublicMenuController;
use App\Http\Controllers\Tenant\TenantSettingsController;
use App\Http\Controllers\Admin\AdminTenantController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\StorageController;

/*
|--------------------------------------------------------------------------
| Landing Pública SaaS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('landing');


/*
|--------------------------------------------------------------------------
| Storage Files (servir imágenes sin storage:link)
|--------------------------------------------------------------------------
*/

Route::get('/storage/{path}', [StorageController::class, 'show'])
    ->where('path', '.*');


/*
|--------------------------------------------------------------------------
| Panel Admin Global SaaS
| (Admin controla tenants y planes)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin.global'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Tenants
        |--------------------------------------------------------------------------
        */

        Route::resource('tenants', AdminTenantController::class);

        /*
        |--------------------------------------------------------------------------
        | Plans
        |--------------------------------------------------------------------------
        */

        Route::resource('plans', AdminPlanController::class);
    });


/*
|--------------------------------------------------------------------------
| Panel Tenant (Owner del negocio)
|--------------------------------------------------------------------------
*/

Route::middleware(['tenant', 'auth', 'tenant.user'])
    ->prefix('/{tenant:slug}/admin')
    ->as('tenant.admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard Owner
        |--------------------------------------------------------------------------
        */

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::get('categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::post('categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::put('categories/{categoryId}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('categories/{categoryId}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Route::get('products', [ProductController::class, 'index'])
            ->name('products.index');

        Route::post('products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::put('products/{productId}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('products/{productId}', [ProductController::class, 'destroy'])
            ->name('products.destroy');

        /*
        |--------------------------------------------------------------------------
        | Tenant Settings
        |--------------------------------------------------------------------------
        */

        Route::get('settings', [TenantSettingsController::class, 'edit'])
            ->name('settings.edit');

        Route::put('settings', [TenantSettingsController::class, 'update'])
            ->name('settings.update');

        Route::get('settings/qr', [TenantSettingsController::class, 'generateQr'])
            ->name('settings.qr');

        Route::get('settings/qr/download', [TenantSettingsController::class, 'downloadQrImage'])
            ->name('settings.qr.download');

        Route::get('settings/qr/poster', [TenantSettingsController::class, 'downloadQrPoster'])
            ->name('settings.qr.poster');
            
            });




/*
|--------------------------------------------------------------------------
| Perfil Usuario
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Rutas de Autenticación Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Analytics Tracking
|--------------------------------------------------------------------------
*/

Route::post('/analytics/track', [AnalyticsController::class, 'track'])
    ->name('analytics.track');

/*
|--------------------------------------------------------------------------
| Catálogo Público del Tenant
|--------------------------------------------------------------------------
*/

Route::middleware(['tenant'])
    ->prefix('/{tenant:slug}')
    ->group(function () {

        Route::get('/', [PublicMenuController::class, 'index'])
            ->name('tenant.public.menu');
    });