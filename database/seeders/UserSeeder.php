<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kecamatan dari database
        $kecamatanList = DB::table('kecamatan')->get();

        // Tambah user admin & kepala KUA
        $users = [
            [
                'nip' => '1234567890',
                'username' => 'admin',
                'nama_pengguna' => 'Administrator',
                'kecamatan_id' => null,
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '1987654321',
                'username' => 'kepala',
                'nama_pengguna' => 'Kepala KUA',
                'kecamatan_id' => null,
                'password' => Hash::make('kepala123'),
                'role' => 'kua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Tambah user operator untuk setiap kecamatan
        foreach ($kecamatanList as $index => $kec) {
            $nip = str_pad((1000 + $index), 10, '0', STR_PAD_LEFT);
            $username = 'operator_' . Str::slug($kec->nama_kecamatan, '_');

            $users[] = [
                'nip' => $nip,
                'username' => $username,
                'nama_pengguna' => 'Operator ' . $kec->nama_kecamatan,
                'kecamatan_id' => $kec->id,
                'password' => Hash::make('password123'),
                'role' => 'operator',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Masukkan ke tabel users
        DB::table('users')->insert($users);
    }
}
