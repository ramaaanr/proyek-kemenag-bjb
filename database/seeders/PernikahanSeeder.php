<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PernikahanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $idPria = DB::table('prias')->pluck('id')->toArray();
        $idPerempuan = DB::table('perempuans')->pluck('id')->toArray();
        $idKelurahan = DB::table('kelurahan')->pluck('id')->toArray();

        foreach (range(1, 1000) as $i) {
            DB::table('pernikahans')->insert([
                'id_pria' => $faker->randomElement($idPria),
                'id_perempuan' => $faker->randomElement($idPerempuan),
                'id_user' => $faker->numberBetween(11, 17), // bisa juga di-random dari user yang ada
                'id_kelurahan' => $faker->randomElement($idKelurahan),
                'tanggal_pernikahan' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'hasil_rujukan' => $faker->randomElement(['ya', 'tidak']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
