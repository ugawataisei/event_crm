<?php

namespace App\Http\Actions\User\Event;

use App\Http\Controllers\Controller;
use App\Http\Services\EventService;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EventShowAction extends Controller
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function __invoke(Request $request, int $id): View
    {
        /** @var Event $model */
        $model = Event::query()->findOrFail($id);

        /** @var Collection $reservations */
        $reservations = Reservation::query()
            ->where('event_id', $id)
            ->whereNull('canceled_date')
            ->get();

        $viewParams = [
            'model' => $model,
            'reservations' => $reservations,
            'num_of_people' => $this->eventService->returnNumOfPeople($model)
        ];

        return view('user.event.show', $viewParams);
    }
}
