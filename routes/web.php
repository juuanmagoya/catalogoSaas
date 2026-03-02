<?php
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing Principal (SaaS)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rutas del Tenant
|--------------------------------------------------------------------------
*/

Route::middleware(['tenant'])
    ->prefix('t/{subdomain}/admin')
    ->as('tenant.admin.')
    ->group(function () {

        // LISTAR
        Route::get('categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        // CREAR
        Route::post('categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        // ACTUALIZAR
        Route::put('categories/{categoryId}', [CategoryController::class, 'update'])
            ->name('categories.update');

        // ELIMINAR
        Route::delete('categories/{categoryId}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');

    });