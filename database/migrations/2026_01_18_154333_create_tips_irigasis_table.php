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
        Schema::create('tips_irigasis', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number')->default(0);
            $table->string('title');
            $table->text('description');
            $table->longText('content_padi')->nullable();
            $table->longText('content_jagung')->nullable();
            $table->longText('content_kedelai')->nullable();
            $table->longText('content_singkong')->nullable();
            $table->longText('content_ubi')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tips_irigasis');
    }
};
