<?php

namespace App\Http\Actions\User\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Reservation\ReservationUpdateRequest;
use App\Models\Event;
use App\Services\Impl\ReservationServiceInterface;
use App\Services\ReservationService;
use Illuminate\Http\RedirectResponse;

class ReservationUpdateAction extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     *
     * @param ReservationUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(ReservationUpdateRequest $request): RedirectResponse
    {
        /** @var Event $model */
        $model = $this->reservationService->updateReservationByRequest($request);

        return redirect()->route('user.event.show', ['id' => $model->id])
            ->with([
                'status' => 'info',
                'message' => trans('message.common.success_update'),
            ]);
    }
}
