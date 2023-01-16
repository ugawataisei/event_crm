<?php

namespace App\Http\Actions\User\Reservation;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationCreateAction extends Controller
{
    /**
     *
     * @param Request $request
     * @param int $event_id
     * @return View
     */
    public function __invoke(Request $request, int $event_id): View
    {
        /** @var Event $model */
        $model = Event::query()
            ->findOrFail($event_id);

        /** @var Reservation $reservation */
        $reservation = Reservation::query()
            ->where('event_id', $model->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($reservation !== null) {
            return view('user.reservation.edit', compact('reservation', 'model'));
        }

        return view('user.reservation.create', compact('model'));
    }
}
