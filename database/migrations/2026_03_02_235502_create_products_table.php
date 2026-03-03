<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Multi-tenant isolation
            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            // Relación con categoría
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_available')->default(true);

            $table->timestamps();

            // 🔥 Evita slugs duplicados dentro del mismo tenant
            $table->unique(['tenant_id', 'slug']);

            // Índice útil para filtros por categoría dentro del tenant
            $table->index(['tenant_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};