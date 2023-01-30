<?php

namespace App\Services;

use App\Consts\EventConst;
use App\Http\Requests\Manager\Event\EventStoreRequest;
use App\Http\Requests\Manager\Event\EventUpdateRequest;
use App\Models\Event;
use App\Models\Reservation;
use App\Services\Impl\EventServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventService implements EventServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllEventsAfterToday(): Collection
    {
        return Event::query()->where('is_visible', EventConst::STATUS_DISPLAY)
            ->whereDate('start_date', '>=', Carbon::now('Asia/Tokyo'))
            ->get();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getEventDetails(int $id): array
    {
        /** @var Event $model */
        $model = Event::query()->findOrFail($id);

        /** @var Collection $reservations */
        $reservations = Reservation::query()
            ->where('event_id', $model->id)
            ->whereNull('canceled_date')
            ->get();

        return [
            'model' => $model,
            'reservations' => $reservations,
        ];
    }

    /**
     * @param EventUpdateRequest|EventStoreRequest $request
     * @param string $startDate
     * @param string $endDate
     * @return bool
     */
    public function checkDuplicationEventTime(EventUpdateRequest|EventStoreRequest $request, string $startDate, string $endDate): bool
    {
        /** @var Event $model */
        $duplicationEventStartDate = Event::query()->where('start_date', '<=', $endDate)->get();
        $duplicationEventEndDate = Event::query()->where('end_date', '>=', $startDate)->get();

        return $duplicationEventStartDate->isNotEmpty() || $duplicationEventEndDate->isNotEmpty();
    }

    /**
     * @param EventStoreRequest $request
     * @return Model|RedirectResponse
     */
    public function storeEventByRequest(EventStoreRequest $request): Model|RedirectResponse
    {
        $startDate = $request->get('event_date') . ' ' . $request->get('start_time');
        $endDate = $request->get('event_date') . ' ' . $request->get('end_time');

        if ($this->checkDuplicationEventTime($request, $startDate, $endDate)) {
            return redirect()->route('manager.event.edit', ['id' => $request->get('id')])->with([
                'status' => 'alert',
                'message' => trans('message.common.error_actions')
            ]);
        }

        return Event::query()->create([
            'name' => $request->get('name'),
            'information' => $request->get('information'),
            'start_date' => Carbon::parse($startDate),
            'end_date' => Carbon::parse($endDate),
            'max_people' => EventConst::MAX_PEOPLE_OPTION[(int)$request->get('max_people')],
            'is_visible' => $request->get('is_visible'),
        ]);
    }

    /**
     * @param EventUpdateRequest $request
     * @return Model|RedirectResponse
     */
    public function updateEventByRequest(EventUpdateRequest $request): Model|RedirectResponse
    {
        $startDate = $request->get('event_date') . ' ' . $request->get('start_time');
        $endDate = $request->get('event_date') . ' ' . $request->get('end_time');

        /** @var Event $model */
        $model = Event::query()->findOrFail((int)$request->get('id'));

        if ($this->checkDuplicationEventTime($request, $startDate, $endDate)) {
            return redirect()->route('manager.event.edit', ['id' => $request->get('id')])->with([
                'status' => 'alert',
                'message' => trans('message.common.error_actions')
            ]);
        }

        $model->fill([
            'name' => $request->get('name'),
            'information' => $request->get('information'),
            'start_date' => Carbon::parse($startDate),
            'end_date' => Carbon::parse($endDate),
            'max_people' => EventConst::MAX_PEOPLE_OPTION[(int)$request->get('max_people')],
            'is_visible' => $request->get('is_visible'),
        ])->save();

        return $model;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function deleteEventByRequest(Request $request): void
    {
        /** @var Event $model */
        $model = Event::query()->findOrFail($request->get('id'));

        $model->delete();
    }
}
