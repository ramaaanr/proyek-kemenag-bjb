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
        Schema::create('pendidikan_perkawinan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkawinan_id')->constrained('perkawinan')->onDelete('cascade');
            $table->integer('laki_sd')->default(0);
            $table->integer('laki_smp')->default(0);
            $table->integer('laki_sma')->default(0);
            $table->integer('laki_sarjana')->default(0);
            $table->integer('wanita_sd')->default(0);
            $table->integer('wanita_smp')->default(0);
            $table->integer('wanita_sma')->default(0);
            $table->integer('wanita_sarjana')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_perkawinan');
    }
};