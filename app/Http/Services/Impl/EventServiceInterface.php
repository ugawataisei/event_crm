<?php

namespace App\Http\Services\Impl;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface EventServiceInterface
{
    public function returnDayInfoForOneWeekToSelect(Carbon $selectedDate): array;

    public function returnReEventsToSelect(Carbon $selectedDate): Collection;

    public function returnNumOfPeople(Event $model): int;
}
