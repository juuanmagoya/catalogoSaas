<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Tenant\PublicMenuController;
use App\Http\Controllers\Admin\AdminTenantController;
use App\Http\Controllers\Admin\AdminPlanController;

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

        Route::get('/', function () {
            return view('tenant.admin.dashboard');
        })->name('dashboard');

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
| Catálogo Público del Tenant
| ⚠️ SIEMPRE AL FINAL PARA NO INTERFERIR CON LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware(['tenant'])
    ->prefix('/{tenant:slug}')
    ->group(function () {

        Route::get('/', [PublicMenuController::class, 'index'])
            ->name('tenant.public.menu');
    });