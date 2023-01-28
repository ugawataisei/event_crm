<?php

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

//未ログイン時
Route::get('/', function () {
    return view('calendar');
});

//dashboard
Route::middleware('can:user')->group(function () {
    Route::get('/dashboard', \App\Http\Actions\User\DashboardAction::class)->name('dashboard');
});

//管理者権限以上
Route::middleware('can:admin')->prefix('admin')->group(function () {
});

//イベントマネージャー権限以上
Route::middleware('can:manager')->prefix('manager')->group(function () {
    Route::get('event/index', \App\Http\Actions\Manager\Event\EventIndexAction::class)->name('manager.event.index');
    Route::get('event/create', \App\Http\Actions\Manager\Event\EventCreateAction::class)->name('manager.event.create');
    Route::get('event/show/{id}', \App\Http\Actions\Manager\Event\EventShowAction::class)->name('manager.event.show');
    Route::get('event/edit/{id}', \App\Http\Actions\Manager\Event\EventEditAction::class)->name('manager.event.edit');
    Route::post('event/update', \App\Http\Actions\Manager\Event\EventUpdateAction::class)->name('manager.event.update');
    Route::post('event/store', \App\Http\Actions\Manager\Event\EventStoreAction::class)->name('manager.event.store');
    Route::post('event/delete', \App\Http\Actions\Manager\Event\EventDeleteAction::class)->name('manager.event.delete');
});

//ユーザー権限以上
Route::middleware('can:user')->prefix('user')->group(function () {
    Route::get('event/show/{id}', \App\Http\Actions\User\Event\EventShowAction::class)->name('user.event.show');
    Route::post('reservation/store', \App\Http\Actions\User\Reservation\ReservationStoreAction::class)
        ->name('user.reservation.store');
    Route::post('reservation/update', \App\Http\Actions\User\Reservation\ReservationUpdateAction::class)
        ->name('user.reservation.update');
    Route::post('reservation/delete', \App\Http\Actions\User\Reservation\ReservationDeleteAction::class)
        ->name('user.reservation.delete');
});
