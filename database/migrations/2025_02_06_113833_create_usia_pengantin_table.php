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
        Schema::create('usia_pengantin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkawinan_id')->constrained('perkawinan')->onDelete('cascade');
            $table->integer('laki_minus_19')->default(0);
            $table->integer('laki_19_21')->default(0);
            $table->integer('laki_21_30')->default(0);
            $table->integer('laki_30_plus')->default(0);
            $table->integer('wanita_minus_19')->default(0);
            $table->integer('wanita_19_21')->default(0);
            $table->integer('wanita_21_30')->default(0);
            $table->integer('wanita_30_plus')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usia_pengantin');
    }
};