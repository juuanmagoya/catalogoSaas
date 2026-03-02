<?php

use Illuminate\Support\Facades\Route;
use App\Support\TenantContext;
use App\Domains\Catalog\Category\Models\Category;

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
| Rutas del Tenant (Por URL)
|--------------------------------------------------------------------------
*/

Route::prefix('t/{subdomain}')
    ->middleware(['tenant'])
    ->group(function () {

        Route::get('/', function () {

            $tenant = TenantContext::getTenant();

            $categories = Category::all();

            $output = "Tenant activo: " . $tenant->name
                . " (Slug: " . $tenant->subdomain . ")<br><br>";

            $output .= "<strong>Categorías:</strong><br>";

            if ($categories->isEmpty()) {
                $output .= "No hay categorías registradas.";
            } else {
                foreach ($categories as $category) {
                    $output .= "- " . $category->name . " (slug: " . $category->slug . ")<br>";
                }
            }

            return $output;
        });

    });