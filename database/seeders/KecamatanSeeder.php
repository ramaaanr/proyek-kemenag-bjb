<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        DB::table('kecamatan')->insert([
            ['id' => '637205', 'nama_kecamatan' => 'Banjarbaru Selatan'],
            ['id' => '637204', 'nama_kecamatan' => 'Banjarbaru Utara'],
            ['id' => '637203', 'nama_kecamatan' => 'Cempaka'],
            ['id' => '637202', 'nama_kecamatan' => 'Landasan Ulin'],
            ['id' => '637206', 'nama_kecamatan' => 'Liang Anggang'],
        ]);
    }
}
