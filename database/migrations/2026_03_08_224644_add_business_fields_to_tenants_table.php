<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {

            // eliminar campo innecesario
            $table->dropColumn('whatsapp_active');

            // redes sociales
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();

            // informacion negocio
            $table->text('description')->nullable();
            $table->string('address')->nullable();

            // logo
            $table->string('logo_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {

            // volver a crear columna eliminada
            $table->boolean('whatsapp_active')->default(true);

            // eliminar columnas agregadas
            $table->dropColumn([
                'instagram',
                'facebook',
                'description',
                'address',
                'logo_path'
            ]);
        });
    }
};