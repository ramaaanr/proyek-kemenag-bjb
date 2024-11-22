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
        Schema::create('status_pernikahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pernikahan');
            $table->string('status');
            $table->date('tanggal_perceraian')->nullable();
            $table->longText('alasan_cerai')->nullable();
            $table->timestamps();
            $table->foreign('id_pernikahan')->references('id')->on('pernikahans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pernikahans');
    }
};
