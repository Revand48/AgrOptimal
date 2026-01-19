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
        Schema::create('simulasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lahan');
            $table->string('jenis_tanaman');
            $table->string('luas_lahan'); // Storing as string to handle formatted values if needed, otherwise decimal
            $table->string('estimasi_panen');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulasis');
    }
};
