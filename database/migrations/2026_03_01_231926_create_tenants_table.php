<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Nombre comercial
            $table->string('subdomain')->unique(); // Subdominio único
            $table->string('email'); // Email principal

            $table->foreignId('plan_id')
                    ->constrained('plans')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();

            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('subscription_ends_at')->nullable();

            $table->enum('status', [
                'trial',
                'active',
                'suspended',
                'expired'
            ])->default('trial');

            $table->timestamps();

            // Índices importantes para rendimiento
            $table->index('subdomain');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};