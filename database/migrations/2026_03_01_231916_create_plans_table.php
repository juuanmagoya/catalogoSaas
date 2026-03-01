<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Nombre del plan
            $table->decimal('price', 10, 2)->default(0); // Precio mensual
            $table->integer('duration_days'); // Duración del plan
            $table->integer('max_products')->nullable(); // Límite de productos (null = ilimitado)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};