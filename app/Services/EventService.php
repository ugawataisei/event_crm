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
     * @Todo: Date 2023/01/29 Author Ugawa Taisei Comment then store event without duplication time
     * @param EventStoreRequest $request
     * @return Model
     */
    public function storeEventByRequest(EventStoreRequest $request): Model
    {
        $startDate = $request->get('event_date') . ' ' . $request->get('start_time');
        $endDate = $request->get('event_date') . ' ' . $request->get('end_time');

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
     * @Todo: Date 2023/01/29 Author Ugawa Taisei Comment then update event without duplication time
     * @param EventUpdateRequest $request
     * @return Model
     */
    public function updateEventByRequest(EventUpdateRequest $request): Model
    {
        $startDate = $request->get('event_date') . ' ' . $request->get('start_time');
        $endDate = $request->get('event_date') . ' ' . $request->get('end_time');

        /** @var Event $model */
        $model = Event::query()->findOrFail((int)$request->get('id'));

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
