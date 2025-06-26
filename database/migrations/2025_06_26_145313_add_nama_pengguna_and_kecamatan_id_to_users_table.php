<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_pengguna')->after('username');
            $table->unsignedBigInteger('kecamatan_id')->nullable()->after('nama_pengguna');

            // Foreign key (jika ada relasi dengan tabel 'kecamatan')
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('set null');
        });
    }

    /**
     * Kembalikan perubahan migrasi.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kecamatan_id']);
            $table->dropColumn(['nama_pengguna', 'kecamatan_id']);
        });
    }
};
