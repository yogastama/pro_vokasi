<?php

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
    Route::get('/', [HomeController::class, 'events'])->name('event.index');
    Route::get('/{id}', [HomeController::class, 'show_event'])->name('event.show');
    Route::get('/register/{id}', [HomeController::class, 'register_event'])->name('event.register');
});
Route::group(['prefix' => 'pro_vokasi'], function () {
    Route::get('/{id}', [HomeController::class, 'show_pro_vokasi'])->name('pro_vokasi.show');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
