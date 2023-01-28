<?php

namespace App\Services\Impl;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface LivewireServiceInterface
{
    public function returnDayInfoForOneWeekToSelect(Carbon $selectedDate): array;

    public function returnReEventsToSelect(Carbon $selectedDate): Collection;
}
