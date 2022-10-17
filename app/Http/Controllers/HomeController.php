<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\ProVokasiServiceModel;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = SliderModel::all();
        $provokasiServices = ProVokasiServiceModel::all();
        $data = [
            'sliders' => $sliders,
            'provokasi_services' => $provokasiServices
        ];
        return view('home.index', $data);
    }
    public function show_pro_vokasi($id)
    {
        $provokasi = ProVokasiServiceModel::find($id);
        $data  = [
            'provokasi' => $provokasi
        ];
        return view('home.pro_vokasi', $data);
    }
}
