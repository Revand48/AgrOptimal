<?php

// database/migrations/xxxx_xx_xx_create_pupuks_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pupuks', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->enum('kategori', ['Subsidi', 'Non Subsidi']);
    $table->integer('kg_per_sak');     // berat 1 sak
    $table->integer('jumlah_sak');     // stok sak tersedia
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pupuks');
    }
};

