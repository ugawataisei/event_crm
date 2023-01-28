<?php

namespace App\Http\Actions\User\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Reservation\ReservationStoreRequest;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class ReservationStoreAction extends Controller
{
    /**
     *
     * @param ReservationStoreRequest $request
     * @return RedirectResponse
     * @throws ModelNotFoundException
     */
    public function __invoke(ReservationStoreRequest $request): RedirectResponse
    {
        /** @var Event $event */
        $event = Event::query()->findOrFail($request->get('event_id'));

        /** @var Collection $reservations */
        $reservations = Reservation::query()
            ->where('event_id', $request->get('event_id'))
            ->get();

        if (!$reservations->isEmpty()) {
            $totalReservationPeople = $request->get('number_of_people');
            foreach ($reservations as $reservation) {
                /** @var Reservation $reservation */
                if ($event->max_people < $totalReservationPeople) {
                    return redirect()->route('manager.event.show', ['id' => $request->get('event_id')])->with([
                        'status' => 'alert',
                        'message' => trans('message.common.error_actions'),
                    ]);
                }
                $totalReservationPeople += $reservation->number_of_people;
            }
        }

        Reservation::query()->create([
            'user_id' => $request->get('user_id'),
            'event_id' => $request->get('event_id'),
            'number_of_people' => $request->get('number_of_people'),
        ]);

        return redirect()->route('manager.event.show', ['id' => $request->get('event_id')])->with([
            'status' => 'info',
            'message' => trans('message.common.success_reservation'),
        ]);
    }
}
