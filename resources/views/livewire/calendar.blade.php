<?php

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/** @var Event $event */
/** @var Carbon $selectedDate */
/** @var array $dayInfoForOneWeekList */
/** @var Collection $selectedDateReEvents */

?>
<div class="card">
    <div class="card-header font-bold">
        {{ __('calendar.title') }}
    </div>
    <div class="card-body row">
        <div class="col-md-2">
            <label for="selected_date" class="form-label font-bold">
                日付選択 <i class="fa-solid fa-calendar-days"></i>
            </label>
        </div>
        <div class="col-md-3">
            <input type="text" id="calendar" name="selected_date" class="form-control"
                   value="{{ $selectedDate }}"
                   wire:change="returnOneWeekForSelectedDate($event.target.value)">
            <div class="flex pt-5">
                @include('components.calendar.columns')

                @include('components.calendar.rows', [
                    'day_info' => $dayInfoForOneWeekList,
                    'event_list' => $selectedDateReEvents,
                ])
            </div>
        </div>
        <div class="col-md-7"></div>
    </div>
    <div class="card-footer">

    </div>
</div>
