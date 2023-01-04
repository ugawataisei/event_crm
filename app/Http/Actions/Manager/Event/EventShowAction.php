<?php

namespace App\Http\Actions\Manager\Event;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class EventShowAction
{
    /**
     *
     * @param int $id
     * @return View
     */
    public function __invoke(int $id): View
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
        ];

        return view('manager.event.show', $viewParams);
    }
}
