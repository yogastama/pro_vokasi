<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceParticipantModel;
use App\Models\EventParticipantModel;
use Illuminate\Http\Request;

class EventScannerController extends Controller
{
    public function index()
    {
        return view('admin.scanner.index');
    }
    public function present_event(Request $request)
    {
        $code = $request->post('code');
        $code = explode('-', $code);
        $id_participant = $code[0];
        $id_event = $code[1];

        $attendance = AttendanceParticipantModel::where('id_event', $id_event)
            ->where('id_participant', $id_participant)
            ->where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')
            ->first();
        if (!$attendance) {
            $attendance = new AttendanceParticipantModel([
                'id_event' => $id_event,
                'id_participant' => $id_participant
            ]);
            $attendance->save();
        }
        $participant = EventParticipantModel::find($id_participant);
        $attendance->ticket_id = $request->post('code');
        $attendance->time = date('d M Y H:i', strtotime($attendance->created_at));
        $attendance->name = $participant->name;

        return response()->json([
            'status' => 'OK',
            'results' => $attendance,
            'message' => 'Berhasil scan'
        ]);
    }
}
