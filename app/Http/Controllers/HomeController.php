<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\ProVokasiServiceModel;
use App\Models\SliderModel;
use Illuminate\Http\Request;

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
    public function events()
    {
        $events = EventModel::all();
        $data = [
            'events' => $events
        ];
        return view('home.events', $data);
    }
    public function show_event($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event
        ];
        return view('home.event', $data);
    }
    public function show_pro_vokasi($id)
    {
        $provokasi = ProVokasiServiceModel::find($id);
        $data  = [
            'provokasi' => $provokasi
        ];
        return view('home.pro_vokasi', $data);
    }
    public function register_event($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event
        ];
        return view('home.register_event', $data);
    }
}
