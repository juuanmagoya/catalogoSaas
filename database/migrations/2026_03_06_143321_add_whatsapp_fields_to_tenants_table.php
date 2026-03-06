<?php

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

            $table->string('whatsapp_number', 20)->nullable(); // Número de WhatsApp para este tenant para landing
            $table->boolean('whatsapp_active')->default(true); // Indica si WhatsApp está activo para este tenant para landing
            $table->string('whatsapp_message', 500)->nullable(); // Mensaje personalizado para WhatsApp en la landing
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_number', 'whatsapp_active', 'whatsapp_message']);
        });
    }
};
