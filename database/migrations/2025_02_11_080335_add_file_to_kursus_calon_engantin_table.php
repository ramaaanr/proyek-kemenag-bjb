<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('kursus_calon_pengantin', function (Blueprint $table) {
            $table->string('file')->nullable(); // Ganti 'some_column' dengan kolom terakhir dalam tabel
        });
    }

    public function down()
    {
        Schema::table('kursus_calon_pengantin', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
