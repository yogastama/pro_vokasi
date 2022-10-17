<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::group(['prefix' => 'events'], function () {
    Route::get('/', [EventController::class, 'index'])->name('event.index');
    Route::get('/{id}', [EventController::class, 'show'])->name('event.show');
    Route::get('/register/{id}', [EventController::class, 'register'])->name('event.register');
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
