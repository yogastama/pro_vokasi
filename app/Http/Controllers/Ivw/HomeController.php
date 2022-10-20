<?php

namespace App\Http\Controllers\Ivw;

use App\Http\Controllers\Controller;
use App\Models\EventModel;
use App\Models\ProVokasiServiceModel;
use App\Models\SliderModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = SliderModel::all();
        $provokasi = ProVokasiServiceModel::all();
        $data = [
            'sliders' => $sliders,
            'provokasi' => $provokasi,
            'events' => EventModel::all()
        ];
        return view('ivw.home', $data);
    }
    public function show($id)
    {
        $provokasi = ProVokasiServiceModel::find($id);
        $provokasis = ProVokasiServiceModel::all();
        $data = [
            'provokasi' => $provokasi,
            'provokasis' => $provokasis,
        ];
        return view('ivw.show', $data);
    }
    public function event($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event,
        ];
        return view('ivw.show_event', $data);
    }
    public function register_event($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event,
        ];
        return view('ivw.register_event', $data);
    }
}
