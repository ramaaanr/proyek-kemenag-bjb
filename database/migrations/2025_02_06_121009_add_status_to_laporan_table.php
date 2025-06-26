<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->enum('status', ['BELUM', 'DIAJUKAN', 'DITOLAK', 'DISETUJUI'])->default('BELUM');
        });
    }

    public function down()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};