<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_events', function (Blueprint $table) {

            $table->id();

            // ID del tenant dueño del catálogo
            $table->unsignedBigInteger('tenant_id')->index();

            // Tipo de evento (menu_view, product_view, category_view)
            $table->string('event_type', 50)->index();

            // Tipo de entidad relacionada (product, category)
            $table->string('entity_type', 50)->nullable()->index();

            // ID del producto o categoría
            $table->unsignedBigInteger('entity_id')->nullable()->index();

            // Fuente de la visita (qr, link, direct)
            $table->string('source', 50)->nullable()->index();

            // IP del visitante
            $table->string('ip', 45)->nullable();

            // Información del navegador/dispositivo
            $table->text('user_agent')->nullable();

            $table->timestamps();

            // Índices compuestos para consultas rápidas
            $table->index(['tenant_id', 'event_type']);
            $table->index(['tenant_id', 'entity_type', 'entity_id']);
            $table->index(['tenant_id', 'source']);
            $table->index(['tenant_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_events');
    }
};