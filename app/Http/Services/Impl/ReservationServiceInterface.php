<?php

namespace App\Http\Services\Impl;

use App\Http\Requests\User\Reservation\ReservationStoreRequest;
use App\Http\Requests\User\Reservation\ReservationUpdateRequest;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


interface ReservationServiceInterface
{
    public function checkReservedEventAuthUser(Event $model): bool;

    public function returnAvailableReservedEventPeople(Event $model): int;

    public function storeReservationByRequest(ReservationStoreRequest $request): Model|RedirectResponse;

    public function updateReservationByRequest(ReservationUpdateRequest $request): Model|RedirectResponse;

    public function deleteReservationByRequest(Request $request): Model;
}
