<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Ivw\AccountController as IvwAccountController;
use App\Http\Controllers\Ivw\HomeController as IvwHomeController;
use App\Models\ProVokasiServiceModel;
use App\Models\SliderModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'desktop'], function () {
    Route::get('/', [IvwHomeController::class, 'index']);
    Route::get('/events', [IvwHomeController::class, 'events'])->name('ivw.events');
    Route::get('/accounts', [IvwAccountController::class, 'accounts'])->name('ivw.accounts');
    Route::get('/login', [IvwAccountController::class, 'login'])->name('ivw.login');
    Route::get('/register', [IvwAccountController::class, 'register'])->name('ivw.register');
    Route::get('/show/{id}', [IvwHomeController::class, 'show'])->name('ivw.show');
    Route::get('/event/{id}', [IvwHomeController::class, 'event'])->name('ivw.event.show');
    Route::get('/event/register/{id}', [IvwHomeController::class, 'register_event'])->name('ivw.event.register');
    Route::get('/success_register_event/{id}/{participant_id}', [IvwHomeController::class, 'success_register_event'])->name('ivw.event.success_register_event');
});

Route::get('/',  function () {
    $agent = new \Jenssegers\Agent\Agent;

    $result = $agent->isMobile();
    if ($result) {
        $sliders = SliderModel::all();
        $provokasiServices = ProVokasiServiceModel::all();
        $data = [
            'sliders' => $sliders,
            'provokasi_services' => $provokasiServices
        ];
        return view('home.index', $data);
    } else {
        return redirect()->to('/desktop');
    }
});
Route::group(['prefix' => 'events'], function () {
    Route::get('/', [EventController::class, 'index'])->name('event.index');
    Route::get('/{id}', [EventController::class, 'show'])->name('event.show');
    Route::get('/register/{id}', [EventController::class, 'register'])->name('event.register');
    Route::post('/save_register/{id}', [EventController::class, 'save_register'])->name('event.save_register');
    Route::post('/is_register_event', [EventController::class, 'is_register_event'])->name('event.is_register_event');
    Route::get('/success_register_event/{id}/{participant_id}', [EventController::class, 'success_register_event'])->name('event.success_register_event');
});
Route::group(['prefix' => 'pro_vokasi'], function () {
    Route::get('/{id}', [HomeController::class, 'show_pro_vokasi'])->name('pro_vokasi.show');
});
Route::group(['prefix' => 'accounts'], function () {
    Route::get('/', [AccountController::class, 'index']);
    Route::get('/login', [AccountController::class, 'login']);
    Route::get('/register', [AccountController::class, 'register']);
    Route::post('/process_login', [AccountController::class, 'process_login'])->name('accounts.process_login');
    Route::post('/process_register', [AccountController::class, 'process_register'])->name('accounts.process_register');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
