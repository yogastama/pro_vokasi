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
        $totalUserCustomer = UserCustomerModel::all()->count();
        $instanceWithTotalUser = DB::select("
            SELECT
                event_participants.institution,
                count(event_participants.id) as total
            FROM event_participants
            WHERE event_participants.event_id = $event->id
            AND event_participants.deleted_at IS NULL
            GROUP BY event_participants.institution
            ORDER BY total DESC
        ");

        $data = [
            'event' => $event,
            'events' => $events,
            'total_user_customer' => $totalUserCustomer,
            'instance_with_total_users' => $instanceWithTotalUser,
            'jumlah_pendaftar_event' => EventParticipantModel::where('event_id', $event->id)->count(),
            'jumlah_pendaftar_event_3_hari_terakhir' => EventParticipantModel::where('event_id', $event->id)->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-3days')))->where('created_at', '<=', date('Y-m-d H:i:s'))->count(),
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
