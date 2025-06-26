<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PriaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 1000) as $i) {
            DB::table('prias')->insert([
                'nama' => $faker->name('male'),
                'usia' => $faker->numberBetween(19, 60),
                'pendidikan' => $faker->randomElement(['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Magister']),
                'sertif_sucatin' => $faker->randomElement(['true', 'false']),
                'kewarganegaraan' => $faker->randomElement(['WNI', 'WNA']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
