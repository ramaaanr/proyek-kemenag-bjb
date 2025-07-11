<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatan = [
            [
                'nama_kecamatan' => 'Banjar Baru Selatan',
                'geojson' => json_encode([
                    "type" => "Polygon",
                    "coordinates" => [[
                        [114.8433, -3.4751],
                        [114.8391, -3.4763],
                        [114.8334, -3.4736],
                        [114.8341, -3.4673],
                        [114.8365, -3.4644],
                        [114.8368, -3.4544],
                        [114.828, -3.4457],
                        [114.8431, -3.4407],
                        [114.8737, -3.4413],
                        [114.8778, -3.4435],
                        [114.8772, -3.4508],
                        [114.8795, -3.4586],
                        [114.8833, -3.4613],
                        [114.8827, -3.4639],
                        [114.8595, -3.466],
                        [114.8566, -3.4686],
                        [114.8512, -3.4692],
                        [114.848, -3.473],
                        [114.8433, -3.4751],
                    ]]
                ])
            ],
            [
                'nama_kecamatan' => 'Banjar Baru Utara',
                'geojson' => json_encode([
                    "type" => "Polygon",
                    "coordinates" => [[
                        [114.883, -3.4615],
                        [114.8795, -3.4586],
                        [114.8772, -3.4508],
                        [114.8778, -3.4435],
                        [114.8741, -3.4413],
                        [114.8428, -3.4407],
                        [114.828, -3.4457],
                        [114.8264, -3.445],
                        [114.8214, -3.4385],
                        [114.8179, -3.4385],
                        [114.8103, -3.4303],
                        [114.8028, -3.425],
                        [114.8009, -3.4144],
                        [114.8095, -3.4194],
                        [114.8144, -3.418],
                        [114.8235, -3.4218],
                        [114.8248, -3.4252],
                        [114.8492, -3.4261],
                        [114.8497, -3.4248],
                        [114.8553, -3.427],
                        [114.8564, -3.4288],
                        [114.8596, -3.4226],
                        [114.8616, -3.4227],
                        [114.867, -3.4291],
                        [114.8681, -3.4356],
                        [114.8727, -3.4355],
                        [114.883, -3.4169],
                        [114.8925, -3.4156],
                        [114.9065, -3.4234],
                        [114.9216, -3.4342],
                        [114.9246, -3.4416],
                        [114.9231, -3.4569],
                        [114.9272, -3.4639],
                        [114.9266, -3.4709],
                        [114.9151, -3.4686],
                        [114.9173, -3.4722],
                        [114.8973, -3.4651],
                        [114.8827, -3.4639],
                        [114.883, -3.4615],
                    ]]
                ])
            ],
            // Tambah data Cempaka, Landasan Ulin, dan Liang Anggang sesuai struktur di atas
        ];

        DB::table('kecamatan')->insert($kecamatan);
    }
}
