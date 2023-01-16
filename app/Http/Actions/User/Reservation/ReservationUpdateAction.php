<?php

namespace App\Http\Actions\User\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Reservation\ReservationUpdateRequest;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class ReservationUpdateAction extends Controller
{
    /**
     *
     * @param ReservationUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(ReservationUpdateRequest $request): RedirectResponse
    {
        /** @var Event $event */
        $event = Event::query()
            ->findOrFail($request->get('event_id'));

        /** @var Collection $reservation */
        $reservations = Reservation::query()
            ->where('event_id', $request->get('event_id'))
            ->get();

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

        Reservation::query()->findOrFail($request->get('reservation_id'))->fill([
            'user_id' => $request->get('user_id'),
            'event_id' => $request->get('event_id'),
            'number_of_people' => $request->get('number_of_people')
        ])->save();

        return redirect()->route('user.reservation.create', ['event_id' => $event->id])->with([
            'status' => 'info',
            'message' => trans('message.common.success_update'),
        ]);
    }
}
