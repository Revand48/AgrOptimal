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
        Schema::create('home_pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // Kendala Website, Pertanyaan, dll
            $table->string('nama');
            $table->string('no_whatsapp');
            $table->text('pesan');
            $table->string('lampiran')->nullable();
            $table->string('status')->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pengaduans');
    }
};
