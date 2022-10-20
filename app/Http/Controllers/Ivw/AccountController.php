<?php

namespace App\Http\Controllers\Ivw;

use App\Http\Controllers\Controller;
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
}
