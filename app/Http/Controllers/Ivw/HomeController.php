<?php

namespace App\Http\Controllers\Ivw;

use App\Http\Controllers\Controller;
use App\Models\EventModel;
use App\Models\EventParticipantModel;
use App\Models\EventTargetModel;
use App\Models\ProVokasiServiceModel;
use App\Models\ResponseEventModel;
use App\Models\SliderModel;
use DateTime;
use Illuminate\Http\Request;
use Spatie\CalendarLinks\Link;

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
    public function events()
    {
        $events = EventModel::has('response_event')->where('is_active', 'active')->get();
        $data = [
            'events' => $events
        ];
        return view('ivw.events', $data);
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
        $participantRecommendations = EventTargetModel::where('event_id', $id)->get();
        $event = EventModel::with('category_event')->find($id);
        $data = [
            'event' => $event,
            'participant_recommendations' => $participantRecommendations
        ];
        return view('ivw.show_event', $data);
    }
    public function register_event($id)
    {
        $event = EventModel::with('category_event')->find($id);
        $participantRecommendations = EventTargetModel::where('event_id', $id)->get();
        $data = [
            'event' => $event,
            'participant_recommendations' => $participantRecommendations
        ];
        return view('ivw.register_event', $data);
    }
    public function success_register_event($id, $participant_id)
    {
        $event = EventModel::with('response_event')->find($id);
        $from = date('Y-m-d H:i', strtotime($event->start_event));
        $from = DateTime::createFromFormat('Y-m-d H:i', "$from");
        $to = date('Y-m-d H:i', strtotime($event->close_event));
        $to = DateTime::createFromFormat('Y-m-d H:i', "$to");

        $link = Link::create('Event ' . $event->title, $from, $to)
            ->description($event->response_event->content ?? 'Hadiri event ini')
            ->address($event->type_event);

        $data = [
            'google_calendar' => $link->google(),
            'yahoo_calendar' => $link->yahoo(),
            'web_outlook' => $link->webOutlook(),
            'web_office' => $link->webOffice(),
            'participant' => EventParticipantModel::find($participant_id),
            'event' => EventModel::find($id),
            'response_event' => ResponseEventModel::where('event_id', $id)->first()
        ];
        return view('ivw.success_register_event', $data);
    }
}
