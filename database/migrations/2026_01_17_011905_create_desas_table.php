<?php

// database/migrations/xxxx_xx_xx_create_desas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('desas', function (Blueprint $table) {
            $table->id();

            // RELASI KE KECAMATAN
            $table->foreignId('kecamatan_id')
                  ->constrained('kecamatans')
                  ->cascadeOnDelete();

            $table->string('nama');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Mencegah nama desa sama dalam satu kecamatan
            $table->unique(['kecamatan_id', 'nama']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
