<?php
namespace App\Services;
use App\Models\User;
use Hamcrest\Core\IsNot;
use Illuminate\Support\Facades\Hash;

class UserServices {
    public function doLogin($data){
        $user = User::where('nip', $data['nip'])->first();
        if ($user){
            if ($user && Hash::check($data['password'], $user->password)) {
                $token = $user->createToken('Login User')->plainTextToken;
                return ([
                    'status' => true,
                    'message' => "Login Berhasil",
                    'token' => $token
                ]);
            }
            return ([
                'status' => false,
                'message' => "Password Salah!"
            ]);

        }
        return ([
            'status' => false,
            'message' => "NIP Salah atau Tidak Terdaftar!"
        ]);
    }
}