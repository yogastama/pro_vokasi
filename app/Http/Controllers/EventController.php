<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = EventModel::with('category_event');
        if ($request->get('search')) {
            $events = $events->where('title', 'like', '%' . $request->get('search') . '%');
        }
        $events = $events->where('is_active', 'active')->get();
        $data = [
            'events' => $events
        ];
        return view('home.events', $data);
    }
    public function show($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event
        ];
        return view('home.event', $data);
    }
    public function register($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event
        ];
        return view('home.register_event', $data);
    }
}
