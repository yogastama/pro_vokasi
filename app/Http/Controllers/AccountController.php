<?php

namespace App\Http\Controllers;

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
                'email'
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


            //* user customer
            $userCustomer = new UserCustomerModel([
                'name' => $request->post('name'),
                'username' => $request->post('username'),
                'password' => bcrypt($request->post('password')),
                'institution_type' => $request->post('institution_type'),
                'institution' => $request->post('institution'),
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
}
