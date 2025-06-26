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
            $table->dropColumn('tempat_pernikahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pernikahans', function (Blueprint $table) {
            $table->string('tempat_pernikahan');
        });
    }
};
