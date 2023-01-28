<?php

namespace App\Http\Actions\User\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Event\EventReservationRequest;
use App\Http\Services\EventService;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EventReserveAction extends Controller
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * @param EventReservationRequest $request
     * @return RedirectResponse
     * @throws ModelNotFoundException
     */
    public function __invoke(EventReservationRequest $request): RedirectResponse
    {
        /** @var Event $model */
        $model = Event::query()->findOrFail($request->get('event_id'));

        /** @var int|null $availableReservedEventPeople */
        $availableReservedEventPeople = $this->eventService->returnAvailableReservedEventPeople($model);

        if ($availableReservedEventPeople === null || $model->max_people < $availableReservedEventPeople + (int)$request->get('num_of_people')) {
            return redirect()->route('user.event.show', ['id' => $request->get('event_id')])->with([
                'status' => 'alert',
                'message' => trans('message.common.error_actions'),
            ]);
        }

        /** @var Reservation $reservation */
        $reservation = Reservation::query()->where('event_id', $model->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($reservation !== null) {
            $reservation->fill([
                'user_id' => $request->get('user_id'),
                'event_id' => $request->get('event_id'),
                'number_of_people' => $request->get('number_of_people'),
            ])->save();

            return redirect()->route('user.event.show', ['id' => $request->get('event_id')])->with([
                'status' => 'info',
                'message' => trans('message.common.success_reservation'),
            ]);
        }

        Reservation::query()->create([
            'user_id' => $request->get('user_id'),
            'event_id' => $request->get('event_id'),
            'number_of_people' => $request->get('number_of_people'),
        ]);

        return redirect()->route('user.event.show', ['id' => $request->get('event_id')])->with([
            'status' => 'info',
            'message' => trans('message.common.success_reservation'),
        ]);
    }
}
