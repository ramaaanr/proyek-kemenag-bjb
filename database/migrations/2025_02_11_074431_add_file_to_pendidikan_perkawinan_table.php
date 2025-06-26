<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pendidikan_perkawinan', function (Blueprint $table) {
            $table->string('file')->nullable(); // Ganti column_name dengan nama kolom terakhir
        });
    }

    public function down()
    {
        Schema::table('pendidikan_perkawinan', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
