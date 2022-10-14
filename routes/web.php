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
Route::get('/events', [HomeController::class, 'events']);
Route::get('/events/{id}', [HomeController::class, 'show_event'])->name('event.show');
Route::get('/events/register/{id}', [HomeController::class, 'register_event'])->name('event.register');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
