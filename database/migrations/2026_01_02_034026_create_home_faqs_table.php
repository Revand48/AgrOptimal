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
        Schema::create('home_faqs', function (Blueprint $table) {
            $table->id();

            $table->string('pertanyaan');          // Judul pertanyaan FAQ
            $table->text('jawaban');               // Isi jawaban
            $table->boolean('status_aktif')->default(true); // Tampil / tidak
            $table->boolean('status_verifikasi')->default(true); // Sudah diverifikasi tim
            $table->integer('urutan')->default(0); // Urutan tampil

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_faqs');
    }
};
