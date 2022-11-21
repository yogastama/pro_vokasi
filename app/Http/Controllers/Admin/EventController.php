<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EventParticipant\AllExport;
use App\Http\Controllers\Controller;
use App\Mail\InvitationMail;
use App\Models\AttendanceParticipantModel;
use Illuminate\Http\Request;
use App\Models\EventModel;
use App\Models\EventParticipantModel;
use App\Models\EventTargetModel;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use QrCode;
use Yajra\DataTables\QueryDataTable;

class EventController extends Controller
{
    public function show($event, Request $request)
    {
        $event = EventModel::with('category_event')->find($event);
        $targetParticipants = [
            'unit_kemenperin' => EventTargetModel::where('event_id', $event->id)->where('key', 'unit_kemenperin')->first(),
            'unit_smk_kemenperin' => EventTargetModel::where('event_id', $event->id)->where('key', 'unit_smk_kemenperin')->first(),
            'unit_kementrian_lembaga' => EventTargetModel::where('event_id', $event->id)->where('key', 'unit_kementrian_lembaga')->first(),
            'unit_industri' => EventTargetModel::where('event_id', $event->id)->where('key', 'unit_industri')->first(),
            'unit_pemerintah_daerah' => EventTargetModel::where('event_id', $event->id)->where('key', 'unit_pemerintah_daerah')->first(),
            'lainnya' => EventTargetModel::where('event_id', $event->id)->where('key', 'lainnya')->first(),
        ];
        $period = new \DatePeriod(
            new \DateTime($event->start_event),
            new \DateInterval('P1D'),
            new \DateTime($event->close_event)
        );
        $instansi = DB::select("
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
            'target_participants' => $targetParticipants,
            'total_event_participants' => EventParticipantModel::where('event_id', $event->id)->count(),
            'total_peserta_hadir' => count(DB::select(
                "SELECT id 
                FROM attendance_participants 
                WHERE id_event = $event->id "
                    . ($request->get('date') != 'all' ? "AND created_at LIKE '%" . $request->get('date') . "%'" : '') .
                    "
                GROUP BY id_participant, id_event"
            )),
            'total_peserta_tidak_hadir' => count(DB::select(
                "SELECT event_participants.id
                FROM event_participants
                WHERE event_participants.event_id = $event->id
                AND NOT EXISTS (
                    SELECT NULL FROM attendance_participants
                    WHERE attendance_participants.id_event = $event->id
                    AND attendance_participants.id_participant = event_participants.id "
                    . ($request->get('date') != 'all' ? "AND attendance_participants.created_at LIKE '%" . $request->get('date') . "%'" : '') .
                    "
                )"
            )),
            'total_peserta_undangan_offline' => EventParticipantModel::where('event_id', $event->id)->where('is_sent_qr', 'yes')->where('is_sent_zoom_link', null)->count(),
            'total_peserta_undangan_online' => EventParticipantModel::where('event_id', $event->id)->where('is_sent_qr', null)->where('is_sent_zoom_link', 'yes')->count(),
            'total_peserta_undangan_keduanya' => EventParticipantModel::where('event_id', $event->id)->where('is_sent_qr', 'yes')->where('is_sent_zoom_link', 'yes')->count(),
            'period' => $period,
            'instansi' => $instansi
        ];
        return view('admin.event.show', $data);
    }
    public function get_waiting_verify($id_event, $type_event)
    {
        $data = EventParticipantModel::where('event_id', $id_event)->where('is_sent_qr', null)->where('is_sent_zoom_link', null)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($type_event) {
                //* cek apakah eventnya hybrid
                $button = '';
                switch ($type_event) {
                    case 'hybrid':
                        $button .= "
                                <a href='" . route('voyager.events.send_link_zoom', ['id_participant' => $row->id]) . "' class='btn btn-primary btn-send-qr'>Kirim link zoom</a>
                                <a href='" . route('voyager.events.send_qr_code', ['id_participant' => $row->id]) . "' class='btn btn-warning btn-send-qr'>Kirim undangan QR Code</a>
                            ";
                        break;
                    case 'online':
                        $button .= "
                                <a href='" . route('voyager.events.send_link_zoom', ['id_participant' => $row->id]) . "' class='btn btn-primary btn-send-qr'>Kirim link zoom</a>
                            ";
                        break;
                    case 'offline':
                        $button .= "
                                <a href='" . route('voyager.events.send_qr_code', ['id_participant' => $row->id]) . "' class='btn btn-warning btn-send-qr'>Kirim undangan QR Code</a>
                            ";
                        break;

                    default:
                        # code...
                        break;
                }
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function get_verified($id_event, $type_event)
    {
        $data = EventParticipantModel::where('event_id', $id_event)->where(function ($query) {
            return $query->where('is_sent_qr', '!=', null)->orWhere('is_sent_zoom_link', '!=', null);
        })->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($type_event) {
                //* cek apakah eventnya hybrid
                $button = '';
                switch ($type_event) {
                    case 'hybrid':
                        $button .= "
                                <a href='" . route('voyager.events.send_link_zoom', ['id_participant' => $row->id]) . "' class='btn btn-primary btn-send-qr'>Kirim link zoom</a>
                                <a href='" . route('voyager.events.send_qr_code', ['id_participant' => $row->id]) . "' class='btn btn-warning btn-send-qr'>Kirim undangan QR Code</a>
                            ";
                        break;
                    case 'online':
                        $button .= "
                                <a href='" . route('voyager.events.send_link_zoom', ['id_participant' => $row->id]) . "' class='btn btn-primary btn-send-qr'>Kirim link zoom</a>
                            ";
                        break;
                    case 'offline':
                        $button .= "
                                <a href='" . route('voyager.events.send_qr_code', ['id_participant' => $row->id]) . "' class='btn btn-warning btn-send-qr'>Kirim undangan QR Code</a>
                            ";
                        break;

                    default:
                        # code...
                        break;
                }
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function send_qr_code($id_participant)
    {
        $participant = EventParticipantModel::find($id_participant);
        $event = EventModel::find($participant->event_id);
        $code = $participant->id . '-' . $participant->event_id;
        //* GENERATE BARCODE
        $response = Http::get("http://128.199.115.183/api/generate?code=$code&header=" . url('/storage') . '/' . $event->header);
        $results = json_decode($response->body(), true);

        //* send whatsapp
        $token = "q8X2WDWZABbDRMNnSJn9UrRxVGtiWQo2SVQwA8TiHnmwNrM2X9";
        $phone = env('APP_ENV') == 'production' ? "$participant->phone_number" : "089617545844"; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $token . '&file=' . $results['results'] . '&number=' . $phone . '&caption=' . "Yth Bapak/Ibu " . $participant->name . ', berikut adalah tiket untuk datang ke lokasi event "' . $event->title . '" pada ' . date('d M Y H:i', strtotime($event->start_event)) . '-' . date('d M Y H:i', strtotime($event->close_event)) . '. Bapak/Ibu dapat menunjukan tiket beserta qr code untuk absensi kehadiran. Terima kasih!',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        if ($response['result']) {
            $participant->update([
                'is_sent_qr' => 'yes'
            ]);
        }

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Success verify user!'
        ]);
    }
    public function send_link_zoom($id_participant)
    {
        $participant = EventParticipantModel::find($id_participant);
        $event = EventModel::find($participant->event_id);
        $code = $participant->id . '-' . $participant->event_id;
        //* GENERATE BARCODE
        $response = Http::get("http://128.199.115.183/api/generate?code=$code");
        $results = json_decode($response->body(), true);

        //* send whatsapp
        $token = "q8X2WDWZABbDRMNnSJn9UrRxVGtiWQo2SVQwA8TiHnmwNrM2X9";
        $phone = env('APP_ENV') == 'production' ? "$participant->phone_number" : "089617545844"; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $token . '&file=' . url('/storage') . '/' . $event->header . '&number=' . $phone . '&caption=' . "Yth Bapak/Ibu " . $participant->name . ', dibawah ini adalah link zoom untuk hadir di event "' . $event->title . '" pada ' . date('d M Y H:i', strtotime($event->start_event)) . '-' . date('d M Y H:i', strtotime($event->close_event)) . ' ya!&date=' . date('Y-m-d') . '&time=' . date('H:i:s'),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        Log::info('text zoom' . $participant->phone_number, json_decode($response, true));
        $response = json_decode($response, true);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_link',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token=' . $token . '&number=' . $phone . '&link=' . $event->link_zoom . '&date=' . date('Y-m-d') . '&time=' . date('H:i:s', strtotime('+10 seconds')),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        Log::info('text zoom link' . $participant->phone_number, json_decode($response, true));
        $response = json_decode($response, true);
        if ($response['result']) {
            $participant->update([
                'is_sent_zoom_link' => 'yes'
            ]);
        }

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Success verify user!'
        ]);
    }
    public function update_target_participants($id_event, Request $request)
    {
        $request->validate([
            'target_participants' => 'required'
        ]);

        $targetParticipants = $request->post('target_participants');
        EventTargetModel::where('event_id', $id_event)->delete();
        foreach ($targetParticipants as $key => $value) {
            $targetParticipant = new EventTargetModel([
                'event_id' => $id_event,
                'key' => $key,
                'value' => ucwords(str_replace('_', ' ', $key))
            ]);
            $targetParticipant->save();
        }

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Success update event targets!'
        ]);
    }
    public function download_participant($event)
    {
        $event = EventModel::find($event);
        return Excel::download(new AllExport($event->id), $event->title . '.xlsx');
    }
    public function table_hadir_event_offline($event, Request $request)
    {
        $data = DB::table('event_participants')
            ->where('event_id', '=', $event)
            ->leftJoin('attendance_participants', 'attendance_participants.id_participant', '=', 'event_participants.id')
            ->where('attendance_participants.id', '!=', null)
            ->groupBy('attendance_participants.id_participant', 'attendance_participants.id_event')
            ->select(['event_participants.*', DB::raw('attendance_participants.created_at as hadir')]);
        if($request->get('date') != 'all'){
            $data = $data->where('attendance_participants.created_at', 'LIKE', '%'.$request->get('date').'%');
        }
        return (new QueryDataTable($data))->toJson();
    }
    public function table_tidak_hadir_event_offline($event, Request $request)
    {
        $date = $request->get('date');
        $data = DB::table('event_participants')
            ->where('event_id', '=', $event)
            ->whereNotExists(function ($query) use ($event, $date) {
                $query->select(DB::raw(1))
                    ->from('attendance_participants')
                    ->whereRaw(($date != 'all' ? 'attendance_participants.created_at LIKE "%'.$date.'%" AND' : '') . ' attendance_participants.id_participant = event_participants.id AND attendance_participants.id_event = ' . $event);
            });

        return (new QueryDataTable($data))->toJson();
    }
}
