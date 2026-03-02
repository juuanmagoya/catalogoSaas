<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // Multi-tenant isolation
            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug');

            $table->text('description')->nullable();
            $table->string('image_path')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // 🔥 IMPORTANTE: evitar slugs duplicados por tenant
            $table->unique(['tenant_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};