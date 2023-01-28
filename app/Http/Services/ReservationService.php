<?php

namespace App\Http\Services;

use App\Http\Requests\User\Reservation\ReservationStoreRequest;
use App\Http\Services\Impl\ReservationServiceInterface;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ReservationService implements ReservationServiceInterface
{
    /**
     *
     * @param Event $model
     * @return int
     */
    public function returnAvailableReservedEventPeople(Event $model): int
    {
        /** @var Reservation $reservedEventPeople */
        $reservedEventPeople = Reservation::query()
            ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
            ->groupBy('event_id')
            ->having('event_id', $model->id)
            ->first();

        if ($reservedEventPeople === null) {
            return $model->max_people;
        }

        return $model->max_people - $reservedEventPeople->number_of_people;
    }

    /**
     * @param ReservationStoreRequest $request
     * @return Model|RedirectResponse
     */
    public function storeReservationByRequest(ReservationStoreRequest $request): Model|RedirectResponse
    {
        /** @var Event $model */
        $model = Event::query()->findOrFail($request->get('event_id'));

//        /** @var Reservation $reservation */
//        $isReserved = $model->reservations->contains(fn($reservation, $key) => $reservation->user_id === Auth::id());

        $availableReservedEventPeople = $this->returnAvailableReservedEventPeople($model);

        if ($model->max_people === $availableReservedEventPeople) {
            return Reservation::query()->create([
                'user_id' => $request->get('user_id'),
                'event_id' => $request->get('event_id'),
                'number_of_people' => $request->get('number_of_people'),
            ]);
        }

        if ($model->max_people <= $availableReservedEventPeople + $request['number_of_people']) {
            return redirect()->route('user.event.show', ['id' => $model->id])->with([
                'status' => 'alert',
                'message' => trans('message.common.fill_reservation_people'),
            ]);
        }

        return Reservation::query()->create([
            'user_id' => $request->get('user_id'),
            'event_id' => $request->get('event_id'),
            'number_of_people' => $request->get('number_of_people'),
        ]);
    }
}
