<?php

namespace App\Http\Actions\User\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Reservation\ReservationStoreRequest;
use App\Http\Services\Impl\ReservationServiceInterface;
use App\Http\Services\ReservationService;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class ReservationStoreAction extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     *
     * @param ReservationStoreRequest $request
     * @return RedirectResponse
     * @throws ModelNotFoundException
     */
    public function __invoke(ReservationStoreRequest $request): RedirectResponse
    {
        /** @var Reservation $model */
        $model = $this->reservationService->storeReservationByRequest($request);

        return redirect()->route('user.event.show', ['id' => $model->id])->with([
            'status' => 'info',
            'message' => trans('message.common.success_reservation'),
        ]);
    }
}
