<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
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
    public function register_event($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event
        ];
        return view('home.register_event', $data);
    }
}
