<?php
// database/migrations/2026_03_06_rename_subdomain_to_slug_in_tenants_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Verificar que la columna 'subdomain' existe antes de renombrar
            if (Schema::hasColumn('tenants', 'subdomain')) {
                $table->renameColumn('subdomain', 'slug');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Verificar que la columna 'slug' existe antes de revertir
            if (Schema::hasColumn('tenants', 'slug')) {
                $table->renameColumn('slug', 'subdomain');
            }
        });
    }
};