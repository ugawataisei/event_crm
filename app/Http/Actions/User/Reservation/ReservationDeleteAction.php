<?php

namespace App\Http\Actions\User\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Services\Impl\ReservationServiceInterface;
use App\Http\Services\ReservationService;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationDeleteAction extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var Reservation $model */
        $model = $this->reservationService->deleteReservationByRequest($request);

        return redirect()->route('user.event.show', ['id' => $model->event_id])
            ->with([
                'status' => 'alert',
                'message' => trans('message.common.success_delete'),
            ]);
    }
}
