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
        Schema::create('peristiwa_perkawinan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkawinan_id')->constrained('perkawinan')->onDelete('cascade');
            $table->integer('kantor')->default(0);
            $table->integer('luar_kantor')->default(0);
            $table->integer('perkawinan_campuran_laki')->default(0);
            $table->integer('perkawinan_campuran_perempuan')->default(0);
            $table->integer('rujuk')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peristiwa_perkawinan');
    }
};