<?php

namespace App\Http\Controllers;

use App\Models\EventParticipantModel;
use App\Models\ProvinceModel;
use App\Models\UserCustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }
    public function login()
    {
        return view('account.login');
    }
    public function register()
    {
        $data = [
            'provinces' => ProvinceModel::all()
        ];
        return view('account.register', $data);
    }
    public function process_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $data = $request->all();
        try {
            $client = Http::post('https://siva.kemenperin.go.id/api/v1/pro_vokasi/auth/login', [
                'username' => $data['username'],
                'password' => $data['password']
            ]);
            $response = json_decode($client->body(), true);
            if ($response['status'] == 'OK') {
                return response()->json([
                    'status' => 'OK',
                    'results' => $response['results']
                ]);
            } else {
                return response()->json([
                    'status' => 'INVALID_REQUEST',
                    'results' => $response['results'],
                    'error_messages' => $response['error_messages']
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'INVALID_REQUEST',
                'results' => [],
                'error_messages' => $th->getMessage()
            ], 400);
        }
    }
    public function process_register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'password' => 'required',
            'jenis_institusi' => 'required',
            'email' => 'required'
        ]);


        try {
            $dataSend = $request->only([
                'username',
                'name',
                'password',
                'email',
                'provinsi'
            ]);
            switch ($request->post('jenis_institusi')) {
                case 'unit_kemenperin':
                    $dataSend['satker'] = $request->post('unit_kemenperin');
                    break;
                case 'unit_smk_kemenperin':
                    $dataSend['formInstitusiSmk'] = $request->post('custom_unit');
                    break;
                case 'unit_industri':
                    $dataSend['formInstitusiIndustri'] = $request->post('custom_unit');
                    break;
                case 'unit_kementrian_lembaga':
                    $dataSend['unit_name'] = $request->post('custom_unit');
                    $dataSend['unit_type'] = $request->post('jenis_institusi');
                    break;
                case 'unit_pemerintah_daerah':
                    $dataSend['unit_name'] = $request->post('custom_unit');
                    $dataSend['unit_type'] = $request->post('jenis_institusi');
                    break;
                case 'lainnya':
                    $dataSend['unit_name'] = $request->post('custom_unit');
                    $dataSend['unit_type'] = $request->post('jenis_institusi');
                    break;
            }
            $client = Http::post('https://siva.kemenperin.go.id/api/v1/pro_vokasi/auth/register', $dataSend);

            $response = json_decode($client->body(), true)['results'];
            if ($client->getStatusCode() == 409) {
                return response()->json([
                    'status' => 'INVALID_REQUEST',
                    'results' => [],
                    'error_messages' => json_decode($client->body(), true)['error_messages']
                ], 400);
            }


            //* user customer
            $userCustomer = new UserCustomerModel([
                'name' => $request->post('name'),
                'username' => $request->post('username'),
                'password' => bcrypt($request->post('password')),
                'institution_type' => $request->post('institution_type'),
                'institution' => $request->post('institution'),
                'email' => $request->post('email'),
            ]);
            $userCustomer->save();

            return response()->json([
                'status' => 'OK',
                'results' => $response
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'INVALID_REQUEST',
                'results' => [],
                'error_messages' => $th->getMessage()
            ], 400);
        }
    }
    public function process_forget_password(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $email = $request->post('email');
        $eventParticipant = EventParticipantModel::where('email', $email)->first();
        if(!$eventParticipant){
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => 'Akun tidak ditemukan!'
            ]);
        }
        $token = "q8X2WDWZABbDRMNnSJn9UrRxVGtiWQo2SVQwA8TiHnmwNrM2X9";
        $phone = $eventParticipant->phone_number;
        $link = route('redirect.reset_password', ['token' => base64_encode($eventParticipant->id)]);
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
            CURLOPT_POSTFIELDS => 'token=' . $token . '&number=' . $phone . '&link=' . $link . '&date=' . date('Y-m-d') . '&time=' . date('H:i:s'),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Link password sudah dikirimkan melalui WhatsApp!'
        ]);
    }
    public function update_password(Request $request)
    {
        $agent = new \Jenssegers\Agent\Agent;
        $request->validate([
            'password' => 'required',
            'konfirmasi_password' => 'required'
        ]);

        $data = $request->all();
        if($data['password'] != $data['konfirmasi_password']){
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => 'Konfirmasi password tidak sama, harap ulangi!'
            ]);
        }
        $token = $data['token'];
        $eventParticipant = EventParticipantModel::find($token);
        try {
            $client = Http::post('https://siva.kemenperin.go.id/api/v1/pro_vokasi/auth/update_password', [
                'email' => $eventParticipant->email,
                'password' => $data['password']
            ]);
            $response = json_decode($client->body(), true);
            if ($response['status'] == 'OK') {
                return redirect()->to($agent->isMobile() ? '/accounts/login' : '/desktop/login')->with([
                    'alert-type' => 'success',
                    'message' => 'Password berhasil diperbarui, silakan login!'
                ]);
            } else {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Silakan ulangi!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
