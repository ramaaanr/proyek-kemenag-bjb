<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('kelurahan', function (Blueprint $table) {
            $table->json('geojson')->nullable(); // sesuaikan 'nama' dengan kolom terakhir yang ada
        });
    }

    /**
     * Kembalikan migrasi.
     */
    public function down(): void
    {
        Schema::table('kelurahan', function (Blueprint $table) {
            $table->dropColumn('geojson');
        });
    }
};
