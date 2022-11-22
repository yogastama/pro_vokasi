<?php

namespace App\Http\Controllers\Ivw;

use App\Http\Controllers\Controller;
use App\Models\EventParticipantModel;
use App\Models\ProvinceModel;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function login()
    {
        return view('ivw.login');
    }
    public function register()
    {
        $provinces = ProvinceModel::all();
        $data = [
            'provinces' => $provinces
        ];
        return view('ivw.register', $data);
    }
    public function accounts()
    {
        return view('ivw.accounts');
    }
    public function forget_password()
    {
        return view('ivw.forget_password');
    }
    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);
        $token = $request->get('token');
        $token = base64_decode($token);

        return view('ivw.reset_password', [
            'token' => $token
        ]);
    }
}
