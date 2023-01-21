<?php

use App\Models\Event;

/** @var Event $event */

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
            {{--  select to date  --}}
            <input type="text" id="calendar" name="selected_date" class="form-control"
                   value="{{ $selectedDate }}"
                   wire:change="returnOneWeekForSelectedDate($event.target.value)">
            {{--  Calendar  --}}
            <div class="flex">
                @foreach($oneWeekForSelectedDate as $date)
                    {{ $date }}
                @endforeach
            </div>
            <div class="flex">
                @foreach($selectedDateReEvents as $event)
                    {{ $event->name }}
                @endforeach
            </div>
        </div>
        <div class="col-md-7"></div>
    </div>
    <div class="card-footer">

    </div>
</div>
