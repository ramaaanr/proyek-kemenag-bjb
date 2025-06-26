<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        DB::table('kelurahan')->insert([
            // Banjarbaru Selatan (637205)
            ['nama_kelurahan' => 'Guntung Paikat', 'id_kecamatan' => '637205'],
            ['nama_kelurahan' => 'Kemuning', 'id_kecamatan' => '637205'],
            ['nama_kelurahan' => 'Loktabat Selatan', 'id_kecamatan' => '637205'],
            ['nama_kelurahan' => 'Sungai Besar', 'id_kecamatan' => '637205'],

            // Banjarbaru Utara (637204)
            ['nama_kelurahan' => 'Komet', 'id_kecamatan' => '637204'],
            ['nama_kelurahan' => 'Loktabat Utara', 'id_kecamatan' => '637204'],
            ['nama_kelurahan' => 'Mentaos', 'id_kecamatan' => '637204'],
            ['nama_kelurahan' => 'Sungai Ulin', 'id_kecamatan' => '637204'],

            // Cempaka (637203)
            ['nama_kelurahan' => 'Bangkal', 'id_kecamatan' => '637203'],
            ['nama_kelurahan' => 'Cempaka', 'id_kecamatan' => '637203'],
            ['nama_kelurahan' => 'Palam', 'id_kecamatan' => '637203'],
            ['nama_kelurahan' => 'Sungai Tiung', 'id_kecamatan' => '637203'],

            // Landasan Ulin (637202)
            ['nama_kelurahan' => 'Guntung Manggis', 'id_kecamatan' => '637202'],
            ['nama_kelurahan' => 'Guntung Payung', 'id_kecamatan' => '637202'],
            ['nama_kelurahan' => 'Landasan Ulin Timur', 'id_kecamatan' => '637202'],
            ['nama_kelurahan' => 'Syamsudin Noor', 'id_kecamatan' => '637202'],

            // Liang Anggang (637206)
            ['nama_kelurahan' => 'Landasan Ulin Barat', 'id_kecamatan' => '637206'],
            ['nama_kelurahan' => 'Landasan Ulin Selatan', 'id_kecamatan' => '637206'],
            ['nama_kelurahan' => 'Landasan Ulin Tengah', 'id_kecamatan' => '637206'],
            ['nama_kelurahan' => 'Landasan Ulin Utara', 'id_kecamatan' => '637206'],
        ]);
    }
}
