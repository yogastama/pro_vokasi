<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\EventScannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Ivw\AccountController as IvwAccountController;
use App\Http\Controllers\Ivw\HomeController as IvwHomeController;
use App\Models\ProVokasiServiceModel;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//* DESKTOP ROUTES
Route::group(['prefix' => 'desktop'], function () {
    Route::get('/', [IvwHomeController::class, 'index']);
    Route::get('/events', [IvwHomeController::class, 'events'])->name('ivw.events');
    Route::get('/accounts', [IvwAccountController::class, 'accounts'])->name('ivw.accounts');
    Route::get('/login', [IvwAccountController::class, 'login'])->name('ivw.login');
    Route::get('/forget_password', [IvwAccountController::class, 'forget_password'])->name('ivw.forget_password');
    Route::get('/reset_password', [IvwAccountController::class, 'reset_password'])->name('ivw.reset_password');
    Route::get('/register', [IvwAccountController::class, 'register'])->name('ivw.register');
    Route::get('/show/{id}', [IvwHomeController::class, 'show'])->name('ivw.show');
    Route::get('/event/{id}', [IvwHomeController::class, 'event'])->name('ivw.event.show');
    Route::get('/event/register/{id}', [IvwHomeController::class, 'register_event'])->name('ivw.event.register');
    Route::get('/success_register_event/{id}/{participant_id}', [IvwHomeController::class, 'success_register_event'])->name('ivw.event.success_register_event');
});

//* MOBILE VERSION
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
Route::get('/reset_password', function(Request $request){
    $agent = new \Jenssegers\Agent\Agent;

    $result = $agent->isMobile();
    if ($result) {
        return redirect()->to('/accounts/reset_password?token=' . $request->get('token'));
    } else {
        return redirect()->to('/desktop/reset_password?token=' . $request->get('token'));
    }
})->name('redirect.reset_password');
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
    Route::get('/forget_password', [AccountController::class, 'forget_password']);
    Route::get('/reset_password', [AccountController::class, 'reset_password']);
    Route::post('/process_login', [AccountController::class, 'process_login'])->name('accounts.process_login');
    Route::post('/process_register', [AccountController::class, 'process_register'])->name('accounts.process_register');
    Route::post('/process_forget_password', [AccountController::class, 'process_forget_password'])->name('accounts.process_forget_password');
    Route::post('/update_password', [AccountController::class, 'update_password'])->name('accounts.update_password');
});

//* ADMIN ROUTES
Route::group(['prefix' => 'admin'], function () {
    Route::get('/events/{event}', [AdminEventController::class, 'show'])->name('voyager.events.show');
    Voyager::routes();
    Route::group(['prefix' => 'events'], function () {
        Route::get('/{event}', [AdminEventController::class, 'show'])->name('voyager.events.show');
        Route::get('/download_participant/{event}', [AdminEventController::class, 'download_participant'])->name('voyager.events.download_participant');
        Route::get('/table_hadir_event_offline/{event}', [AdminEventController::class, 'table_hadir_event_offline'])->name('voyager.events.table_hadir_event_offline');
        Route::get('/table_tidak_hadir_event_offline/{event}', [AdminEventController::class, 'table_tidak_hadir_event_offline'])->name('voyager.events.table_tidak_hadir_event_offline');
        Route::get('/get_waiting_verify/{event}/{type_event}', [AdminEventController::class, 'get_waiting_verify'])->name('voyager.events.get_waiting_verify');
        Route::get('/get_verified/{event}/{type_event}', [AdminEventController::class, 'get_verified'])->name('voyager.events.get_verified');
        Route::get('/send_qr_code/{id_participant}', [AdminEventController::class, 'send_qr_code'])->name('voyager.events.send_qr_code');
        Route::get('/send_link_zoom/{id_participant}', [AdminEventController::class, 'send_link_zoom'])->name('voyager.events.send_link_zoom');
        Route::post('/update_target_participants/{id_event}', [AdminEventController::class, 'update_target_participants'])->name('voyager.events.update_target_participants');
    });
    Route::get('/', [DashboardController::class, 'index'])->name('voyager.dashboard');
    Route::get('/table_list_participants', [DashboardController::class, 'table_list_participants'])->name('voyager.table_list_participants');
    Route::group(['prefix' => 'scanner'], function () {
        Route::get('/', [EventScannerController::class, 'index']);
        Route::post('/present_event', [EventScannerController::class, 'present_event'])->name('scanner.present_event');
    });
});
