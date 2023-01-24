<?php

use App\Models\Event;
use App\Consts\EventConst;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

/** @var array $day_info */
/** @var Collection $event_list */
/** @var Event $event */

?>
@for($i = 0; $i < EventConst::AMOUNT_DAYS_IN_ONE_WEEK; $i++)
    <div>
        <div class="border bg-light text-center py-1">
            {{ $day_info['day'][$i] }}
        </div>
        <div class="border bg-light text-center py-1">
            {{ $day_info['day_name'][$i] }}
        </div>
        @foreach(EventConst::EVENT_TIME_OPTION as $time)
            @if($event_list->isNotEmpty())
                @if($event_list->firstWhere('start_date', Carbon::parse($day_info['day_string'][$i] . ' ' . $time)))
                    <div class="border bg-light font-bold text-sm px-5 py-1">
                        {{ $event_list->first()->name }}
                    </div>
                @else
                    <div class="border px-5 py-1">
                        {{ 'empty' }}
                    </div>
                @endif
            @else
                <div class="border px-5 py-1">
                    {{ 'empty' }}
                </div>
            @endif
        @endforeach
    </div>
@endfor
