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
        Schema::table('products', function (Blueprint $table) {

        $table->index(['tenant_id', 'is_available']);

        $table->index(['tenant_id', 'name']);
        
        $table->index(['tenant_id', 'created_at']);

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

        $table->dropIndex(['tenant_id', 'is_available']);
        $table->dropIndex(['tenant_id', 'name']);
        $table->dropIndex(['tenant_id', 'created_at']);

    });
    }
};
