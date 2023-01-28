<?php

namespace App\Http\Services\Impl;

use App\Http\Requests\User\Reservation\ReservationStoreRequest;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;


interface ReservationServiceInterface
{
    public function returnAvailableReservedEventPeople(Event $model): int;

    public function storeReservationByRequest(ReservationStoreRequest $request): Model|RedirectResponse;
}
