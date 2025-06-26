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
        Schema::create('pernikahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pria');
            $table->unsignedBigInteger('id_perempuan');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kelurahan');
            $table->string('tempat_pernikahan');
            $table->date('tanggal_pernikahan');
            $table->timestamps();
            $table->foreign('id_pria')->references('id')->on('prias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_perempuan')->references('id')->on('perempuans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_kelurahan')->references('id')->on('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pernikahans');
    }
};
