<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EventParticipant\AllExport;
use App\Http\Controllers\Controller;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use App\Models\EventModel;
use App\Models\EventParticipantModel;
use App\Models\EventTargetModel;
use DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use QrCode;

class EventController extends Controller
{
    public function show($event)
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
        $data = [
            'event' => $event,
            'target_participants' => $targetParticipants
        ];
        return view('admin.event.show', $data);
    }
    private function createTicket($img1 = '', $img2 = '', $img3 = '', $ticket_id = '')
    {
        header('Content-Type: image/png');
        $targetFolder = public_path('/images/');
        $targetPath = $targetFolder;

        $outputImage = imagecreatetruecolor(800, 1400);

        $white = imagecolorallocate($outputImage, 255, 255, 255);
        imagefill($outputImage, 0, 0, $white);

        $first = imagecreatefrompng($img1);
        $second = imagecreatefrompng($img2);
        $third = imagecreatefrompng($img3);

        imagecopyresized(
            $outputImage,
            $first,
            0,
            0,
            0,
            0,
            782,
            707,
            782,
            707
        );
        imagecopyresized($outputImage, $second, 260, 787, 0, 0, 300, 300, 300, 300);
        imagecopyresized($outputImage, $third, 0, 1187, 0, 0, 782, 707, 782, 707);

        $filename = $targetPath . $ticket_id . '.png';
        imagepng($outputImage, $filename);

        imagedestroy($outputImage);
        return $filename;
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
}