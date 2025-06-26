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
        Schema::table('pernikahans', function (Blueprint $table) {
            $table->enum('hasil_rujukan', ['ya', 'tidak'])->default('tidak')->after('tanggal_pernikahan');
        });
    }

    public function down(): void
    {
        Schema::table('pernikahans', function (Blueprint $table) {
            $table->dropColumn('hasil_rujukan');
        });
    }
};
