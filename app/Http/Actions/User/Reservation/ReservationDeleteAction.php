<?php

namespace App\Http\Actions\User\Reservation;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationDeleteAction extends Controller
{
    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var Reservation $model */
        $model = Reservation::query()
            ->findOrFail($request->get('id'));

        if ($model === null) {
            return redirect()->route('user.reservation.create', ['event_id' => $model->event_id])->with([
                'status' => 'alert',
                'message' => trans('message.common.error_actions'),
            ]);
        }

        $eventId = $model->event_id;
        $model->delete();

        return redirect()->route('manager.event.show', ['id' => $eventId])->with([
            'status' => 'info',
            'message' => trans('message.common.success_delete'),
        ]);
    }
}
