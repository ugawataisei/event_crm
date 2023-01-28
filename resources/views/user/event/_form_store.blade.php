<?php

use App\Models\Event;

/** @var Event $model */
/** @var int $available_reserved_event_people */

?>
{{ Form::open(['route' => 'user.reservation.store', 'method' => 'post']) }}
@method('POST')
@csrf

{{ Form::hidden('user_id', auth()->id()) }}
{{ Form::hidden('event_id', $model->id) }}
<div class="row">
    <div class="col-md-3">
        <label>{{ __('reservation.attribute_labels.number_of_people') }}</label>
    </div>
    <div class="col-md-3">
        @if($available_reserved_event_people === 0)
            <span class="alert alert-danger" role="alert">
                {{ __('message.common.fill_reservation_people') }}
            </span>
        @else
            <label class="form-control">
                <select name="number_of_people" class="form-control">
                    <option value="">予約人数を選択してください</option>
                    @for($i = 1; $i <= $available_reserved_event_people ; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </label>
        @endif
    </div>
    <div class="col-md-6"></div>
</div>
<div class="row mt-2">
    <div class="col-md-3">
        <button type="button" class="btn btn-secondary"
                onclick="location.href='{{ route('dashboard') }}'">
            <i class="fa-solid fa-calendar-days"></i>{{ __('message.btn_labels.back') }}
        </button>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-dark">
            <i class="fa-regular fa-id-card"></i>{{ __('message.btn_labels.reservation') }}
        </button>
    </div>
    <div class="col-md-6"></div>
</div>
{{ Form::close() }}
