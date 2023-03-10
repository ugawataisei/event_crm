<?php

namespace App\Services;

use App\Consts\EventConst;
use App\Models\Event;
use App\Models\Reservation;
use App\Services\Impl\LivewireServiceInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LivewireService implements LivewireServiceInterface
{
    /**
     *
     * @param Carbon $selectedDate
     * @return array
     */
    public function returnDayInfoForOneWeekToSelect(Carbon $selectedDate): array
    {
        $dayInfoForOneWeekList = [];
        for ($i = 0; $i < EventConst::AMOUNT_DAYS_IN_ONE_WEEK; $i++) {
            $dayInfoForOneWeekList['day'][] = $selectedDate->copy()
                ->addDays($i)->format('m月d日');
            $dayInfoForOneWeekList['day_name'][] = $selectedDate->copy()
                ->addDays($i)->dayName;
            $dayInfoForOneWeekList['day_string'][] = $selectedDate->copy()
                ->addDays($i)->format('Y-m-d');
        }
        return $dayInfoForOneWeekList;
    }

    /**
     *
     * @param Carbon $selectedDate
     * @return Collection
     */
    public function returnReEventsToSelect(Carbon $selectedDate): Collection
    {
        /** @var Builder $reservations */
        $reservedEventPeople = Reservation::query()
            ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
            ->groupBy('event_id');

        $addSevenDaysDate = $selectedDate->copy()->addDays(EventConst::AMOUNT_DAYS_IN_ONE_WEEK);
        return Event::query()->leftJoinSub($reservedEventPeople, 'reserved_event_people', function ($join) {
            $join->on('events.id', '=', 'reserved_event_people.event_id');
        })->whereBetween('start_date', [$selectedDate, $addSevenDaysDate])
            ->orderBy('start_date', 'asc')
            ->get();
    }
}
