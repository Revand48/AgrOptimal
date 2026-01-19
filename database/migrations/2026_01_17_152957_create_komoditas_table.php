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
        Schema::create('komoditas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique(); // For potentially pretty URLs or internal refs
            $table->integer('duration_days'); // harvest_days
            $table->decimal('yield_per_ha', 8, 2); // Ton/Ha
            $table->decimal('price_per_kg', 12, 2)->default(0); // For estimation
            
            // Risk & Info
            $table->text('description')->nullable();
            $table->text('risks')->nullable(); // JSON or text list of risks
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komoditas');
    }
};
