<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_chat_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_online')->default(false);
            $table->unsignedInteger('max_active_chats')->default(2);
            $table->timestamps();
        });

        // Seed default row
        DB::table('admin_chat_settings')->insert([
            'is_online' => false,
            'max_active_chats' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_chat_settings');
    }
};
