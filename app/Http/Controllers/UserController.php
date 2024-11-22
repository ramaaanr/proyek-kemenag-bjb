<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userServices;
    function __construct()
    {
        $this->userServices = new UserServices;
    }

    public function login(Request $request){
        $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);
        $results = $this->userServices->doLogin($request->all());
        return $results;
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return ([
            'status' => true,
            'message' => "Token Dihapus!"
        ]);
    }
}
