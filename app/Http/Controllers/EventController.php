<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\EventParticipantModel;
use App\Models\ResponseEventModel;
use DateTime;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\CalendarLinks\Link;

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
    public function save_register($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'instansi' => 'required',
            'phone' => 'required',
            'jenis_kelamin' => 'required',
            'token_siva' => 'required'
        ]);

        try {
            //* get user
            $client = Http::post('https://siva.kemenperin.go.id/api/v1/pro_vokasi/auth/get_user', [
                'email' => $request->post('email'),
                'token' => $request->post('token_siva')
            ]);
            $response = json_decode($client->body(), true);
            if ($response['status'] == 'OK') {
                $user = $response['results'];
                $participant = new EventParticipantModel([
                    'siva_user_id' => $user['siva_user_id'],
                    'siva_type_user' => $user['institution_type'],
                    'name' => $user['name'],
                    'gender' => $request->post('jenis_kelamin'),
                    'email' => $user['email'],
                    'phone_number' => $request->post('phone'),
                    'institution' => $user['institution'],
                    'event_id' => $id,
                    'institution_type' => $request->post('jenis_instansi')
                ]);
                $participant->save();

                return redirect()->route('event.success_register_event', ['id' => $id, 'participant_id' => $participant->id])->with([
                    'alert-type' => 'success',
                    'message' => 'Berhasil terdaftar, silakan ikuti instruksi berikut!'
                ]);
            }
            abort(500, 'Silakan kembali dan ulangi pendaftaran');
        } catch (\Throwable $th) {
            abort(500, 'Silakan kembali dan ulangi pendaftaran');
        }
    }
    public function success_register_event($id, $participant_id)
    {
        $event = EventModel::with('response_event')->find($id);
        $from = date('Y-m-d H:i', strtotime($event->start_event));
        $from = DateTime::createFromFormat('Y-m-d H:i', "$from");
        $to = date('Y-m-d H:i', strtotime($event->close_event));
        $to = DateTime::createFromFormat('Y-m-d H:i', "$to");

        $link = Link::create('Event ' . $event->title, $from, $to)
            ->description($event->response_event->content)
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
        return view('home.success_register_event', $data);
    }
    public function is_register_event(Request $request)
    {
        $participant = EventParticipantModel::where('event_id', $request->post('event_id'))
            ->where('email', $request->post('email'))->first();
        return response()->json([
            'status' => 'OK',
            'results' => $participant
        ]);
    }
}
