<?php

use App\Consts\EventConst;

?>
<div>
    <div class="border px-2 py-1">
        {{ __('calendar.day') }}
    </div>
    <div class="border px-2 py-1">
        {{ __('calendar.day_name') }}
    </div>
    @foreach(EventConst::EVENT_TIME_OPTION as $time)
        <div class="border px-2 py-1">
            {{ $time }}
        </div>
    @endforeach
</div>
