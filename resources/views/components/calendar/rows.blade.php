<?php

use App\Models\Event;
use App\Consts\EventConst;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

/** @var array $day_info */
/** @var Collection $event_list */
/** @var Event $model */

?>
@for($i_day = 0; $i_day < EventConst::AMOUNT_DAYS_IN_ONE_WEEK; $i_day++)
    <div class="w-full">
        <div class="border bg-light text-center py-1">
            {{ $day_info['day'][$i_day] }}
        </div>
        <div class="border bg-light text-center py-1">
            {{ $day_info['day_name'][$i_day] }}
        </div>

        @for($i_time = 0; $i_time < count(EventConst::EVENT_TIME_OPTION); $i_time++)
            @if($event_list->isNotEmpty())
                @php
                    $model = $event_list->firstWhere('start_date', Carbon::parse($day_info['day_string'][$i_day] . ' ' . EventConst::EVENT_TIME_OPTION[$i_time]));
                    if ($model !== null) {
                        $period = $model->start_date->diffInMinutes($model->end_date) / 30 - 1;
                    }
                @endphp
                @if($model)
                    {{-- can show event then login --}}
                    @can('user')
                        <a href="{{ route('user.event.show', ['id' => $model->id]) }}"
                           class="border bg-dark font-bold text-white px-5 py-1">{{ $model->name}}
                        </a>
                    @endcan
                    {{-- can not show event then not login --}}
                    @cannot('user')
                        <div class="border bg-dark font-bold text-white px-5 py-1">
                            {{ $model->name }}
                        </div>
                    @endcannot
                    @for($i_period = 0; $i_period < $period; $i_period++)
                        <div class="border bg-dark text-white px-5 py-1">
                            {{ 'period' }}
                        </div>
                        @php $i_time++ @endphp
                    @endfor
                @else
                    <div class="border bg-secondary px-5 py-1">
                        {{ 'empty' }}
                    </div>
                @endif
            @else
                <div class="border bg-secondary px-5 py-1">
                    {{ 'empty' }}
                </div>
            @endif
        @endfor
    </div>
@endfor
