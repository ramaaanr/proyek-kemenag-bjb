<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userServices;

    function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        try {
            $results = $this->userServices->doLogin($request->all());

            if ($results['status']) {
                return redirect()->route('dashboard')->with('success', $results['message']);
            }

            return redirect()->route('login')->with('error', $results['message']);
        } catch (\Exception $e) {
            Log::error('Login Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Terjadi kesalahan pada server!');
        }
    }

    public function logout()
    {
        try {
            $this->userServices->doLogout();
            return redirect()->route('login')->with('success', "Berhasil Logout!");
        } catch (\Exception $e) {
            Log::error('Logout Error: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Gagal logout, coba lagi!');
        }
    }
}