<?php

use App\Models\Event;
use App\Models\Reservation;

/** @var Event $model */
/** @var Reservation $reservation */

?>
{{ Form::open(['route' => 'user.reservation.update', 'method' => 'post']) }}
@method('POST')
@csrf

{{ Form::hidden('user_id', auth()->id()) }}
{{ Form::hidden('event_id', $model->id) }}
{{ Form::hidden('reservation_id', $reservation->id) }}
<div class="row">
    <span class="alert alert-success text-center" role="alert">
        既に予約情報が存在します
    </span>
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
                        <option value="{{ $i }}" @if ($i === $reservation->number_of_people) selected @endif>
                            {{ $i }}
                        </option>
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
        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-pen"></i>{{ __('message.btn_labels.update') }}
        </button>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#delete{{ $reservation->id }}">
            <i class="fa-solid fa-trash"></i>{{ __('message.btn_labels.delete') }}
        </button>
    </div>
    <div class="col-md-3"></div>
</div>
{{ Form::close() }}

@include('components.delete-modal', [
    'title' => __('reservation.delete_title'),
    'route' => 'user.reservation.delete',
    'model' => $reservation,
])
