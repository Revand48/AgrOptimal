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
        Schema::table('cek_tanahs', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug');
            $table->longText('content')->nullable()->change(); // Make content nullable
            $table->longText('content_padi')->nullable()->after('description');
            $table->longText('content_jagung')->nullable()->after('content_padi');
            $table->longText('content_kedelai')->nullable()->after('content_jagung');
            $table->longText('content_singkong')->nullable()->after('content_kedelai');
            $table->longText('content_ubi')->nullable()->after('content_singkong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cek_tanahs', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'content_padi',
                'content_jagung',
                'content_kedelai',
                'content_singkong',
                'content_ubi'
            ]);
        });
    }
};
