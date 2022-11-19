<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\EventParticipantModel;
use App\Models\UserCustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->to('/admin/login');
        }
        $event = EventModel::where('is_active', 'active');
        if ($request->get('event_id')) {
            $event = $event->find($request->get('event_id'));
        } else {
            $event = $event->latest()->first();
        }
        $events = EventModel::all();

        $totalEventParticipants = new EventParticipantModel();
        if($request->get('event_id') != 'all'){
            $totalEventParticipants = $totalEventParticipants->where('event_id', $event->id);
        }
        $totalEventParticipants = $totalEventParticipants->count();
        $data = [
            'event' => $event,
            'events' => $events,
            'total_user_customer' => UserCustomerModel::all()->count(),
            'event' => $event,
            'total_event_participants' => $totalEventParticipants,
            'total_peserta_hadir' => $request->get('event_id') != 'all' ? count(DB::select(
                "SELECT id 
                FROM attendance_participants 
                WHERE id IS NOT NULL "
                    . ($request->get('date') != 'all' ? "AND created_at LIKE '%" . $request->get('date') . "%'" : '') .
                    ($request->get('event_id') != 'all' ? "AND id_event = '" . $request->get('event_id') . "'" : '') .
                    "
                GROUP BY id_participant, id_event"
            )) : 0,
            'total_peserta_tidak_hadir' => $request->get('event_id') != 'all' ? count(DB::select(
                "SELECT event_participants.id
                FROM event_participants
                WHERE event_participants.id IS NOT NULL
                ".($request->get('event_id') != 'all' ? "AND event_participants.event_id = '%" . $request->get('event_id') . "'" : '')."
                AND NOT EXISTS (
                    SELECT NULL FROM attendance_participants
                    WHERE attendance_participants.id_participant = event_participants.id "
                    . ($request->get('date') != 'all' ? "AND attendance_participants.created_at LIKE '%" . $request->get('date') . "%'" : '') .
                    ($request->get('event_id') != 'all' ? "AND attendance_participants.id_event = '%" . $request->get('event_id') . "'" : '').
                    "
                )"
            )) : 0,
            'total_peserta_undangan_offline' => $request->get('event_id') != 'all' ? EventParticipantModel::where('event_id', $event->id)->where('is_sent_qr', 'yes')->where('is_sent_zoom_link', null)->count() : 0,
            'total_peserta_undangan_online' => $request->get('event_id') != 'all' ? EventParticipantModel::where('event_id', $event->id)->where('is_sent_qr', null)->where('is_sent_zoom_link', 'yes')->count() : 0,
            'total_peserta_undangan_keduanya' => $request->get('event_id') != 'all' ? EventParticipantModel::where('event_id', $event->id)->where('is_sent_qr', 'yes')->where('is_sent_zoom_link', 'yes')->count() : 0,
            
            'instansi' => DB::select("
                SELECT
                    event_participants.institution,
                    count(event_participants.id) as total
                FROM event_participants
                WHERE event_participants.deleted_at IS NULL
                ".($request->get('event_id') != 'all' ? "AND event_participants.event_id = $event->id" : '')."
                GROUP BY event_participants.institution
                ORDER BY total DESC
            ")
        ];

        return view('admin.dashboard.index', $data);
    }
    public function table_list_participants(Request $request)
    {
        $eventParticipants = EventParticipantModel::where('event_id', $request->get('event_id'));
        return DataTables::of($eventParticipants)->addColumn('action', function ($row) {

            $btn = "<a target='_blank' href='" . route('voyager.event-participants.show', ['id' => $row->id]) . "' class='edit btn btn-primary btn-sm'>View</a>";
            $btn .= "<a target='_blank' href='" . route('voyager.event-participants.edit', ['id' => $row->id]) . "' class='edit btn btn-warning btn-sm'>Edit</a>";

            return $btn;
        })
            ->editColumn('gender', function ($row) {
                return str_replace('_', ' ', $row->gender);
            })
            ->editColumn('created_at', function ($row) {
                return date('d M Y H:i', strtotime($row->created_at));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
