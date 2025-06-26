<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserServices
{
    public function doLogin($data)
    {
        try {
            $user = User::where('nip', $data['nip'])->first();

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return [
                    'status' => false,
                    'message' => "NIP atau Password Salah!"
                ];
            }

            // Login user menggunakan Laravel Auth
            Auth::login($user);

            // Simpan informasi user di session
            Session::put('user', [
                'id' => $user->id,
                'nip' => $user->nip,
                'name' => $user->name,
                'role' => $user->role
            ]);

            return [
                'status' => true,
                'message' => "Login Berhasil"
            ];
        } catch (\Exception $e) {
            Log::error('Login Error: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => "Terjadi kesalahan, silakan coba lagi!"
            ];
        }
    }

    public function doLogout()
    {
        try {
            Auth::logout();
            Session::flush();
            return [
                'status' => true,
                'message' => "Logout Berhasil"
            ];
        } catch (\Exception $e) {
            Log::error('Logout Error: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => "Gagal logout, coba lagi!"
            ];
        }
    }
}