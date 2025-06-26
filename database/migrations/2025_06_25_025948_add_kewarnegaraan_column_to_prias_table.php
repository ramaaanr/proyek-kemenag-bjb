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
        Schema::table('prias', function (Blueprint $table) {
            $table->enum('kewarganegaraan', ['WNI', 'WNA'])->default('WNI')->after('sertif_sucatin');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prias', function (Blueprint $table) {
            $table->dropColumn('kewarganegaraan');
        });
    }
};
