<?php

namespace App\Services;

use App\Http\Requests\User\Reservation\ReservationStoreRequest;
use App\Http\Requests\User\Reservation\ReservationUpdateRequest;
use App\Models\Event;
use App\Models\Reservation;
use App\Services\Impl\ReservationServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationService implements ReservationServiceInterface
{
    /**
     * @param Event $model
     * @return bool
     */
    public function checkReservedEventAuthUser(Event $model): bool
    {
        /** @var Reservation $reservation */
        return $model->reservations
            ->whereNull('canceled_date')
            ->contains(fn($reservation, $key) => $reservation->getRawOriginal('user_id') === Auth::id());
    }

    /**
     *
     * @param Event $model
     * @return int
     */
    public function returnAvailableReservedEventPeople(Event $model): int
    {
        /** @var Reservation $reservedEventPeople */
        $reservedEventPeople = Reservation::query()
            ->whereNull('canceled_date')
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

        $availableReservedEventPeople = $this->returnAvailableReservedEventPeople($model);

        if ($model->max_people === $availableReservedEventPeople) {
            return Reservation::query()->create([
                'user_id' => $request->get('user_id'),
                'event_id' => $request->get('event_id'),
                'number_of_people' => $request->get('number_of_people'),
            ]);
        }

        if ($model->max_people <= $availableReservedEventPeople + $request['number_of_people']) {
            return redirect()->route('user.event.show', ['id' => $model->id])
                ->with([
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

    /**
     * @param ReservationUpdateRequest $request
     * @return Model|RedirectResponse
     */
    public function updateReservationByRequest(ReservationUpdateRequest $request): Model|RedirectResponse
    {
        /** @var Event $event */
        $event = Event::query()->findOrFail($request->get('event_id'));

        /** @var Reservation $reservation */
        $reservation = Reservation::query()->findOrFail($request->get('reservation_id'));

        $availableReservedEventPeople = $this
                ->returnAvailableReservedEventPeople($event) - $reservation->number_of_people;

        if ($event->max_people <= $availableReservedEventPeople + $request['number_of_people']) {
            return redirect()->route('user.event.show', ['id' => $event->id])
                ->with([
                    'status' => 'alert',
                    'message' => trans('message.common.fill_reservation_people'),
                ]);
        }

        $reservation->fill([
            'user_id' => $request->get('user_id'),
            'event_id' => $request->get('event_id'),
            'number_of_people' => $request->get('number_of_people')
        ])->save();

        return $event;
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function deleteReservationByRequest(Request $request): Model
    {
        /** @var Reservation $model */
        $model = Reservation::query()->findOrFail($request->get('id'));

        $model->fill([
            'canceled_date' => Carbon::now()
        ])->save();

        return $model;
    }
}
