<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_data', function (Blueprint $table) {
            $table->id();
            $table->integer('total_pupuk');          // kg
            $table->integer('jenis_pupuk');
            $table->integer('petani_terdampak');
            $table->decimal('rating', 2, 1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_data');
    }
};
?>
