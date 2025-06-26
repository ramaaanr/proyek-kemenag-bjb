<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('usia_pengantin', function (Blueprint $table) {
            $table->string('file')->nullable(); // Ganti 'kolom_terakhir' dengan nama kolom terakhir pada tabel
        });
    }

    public function down()
    {
        Schema::table('usia_pengantin', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
