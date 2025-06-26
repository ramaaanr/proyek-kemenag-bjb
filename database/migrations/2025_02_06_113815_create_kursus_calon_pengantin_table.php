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
        Schema::create('kursus_calon_pengantin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkawinan_id')->constrained('perkawinan')->onDelete('cascade');
            $table->integer('jumlah_laki')->default(0);
            $table->integer('jumlah_wanita')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_calon_pengantin');
    }
};