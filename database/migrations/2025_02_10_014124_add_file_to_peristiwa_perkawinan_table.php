<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('peristiwa_perkawinan', function (Blueprint $table) {
            $table->string('file')->nullable()->after('rujuk'); // Tambahkan kolom file
        });
    }

    public function down()
    {
        Schema::table('peristiwa_perkawinan', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
