<?php

use App\Models\Event;
use App\Models\Reservation;

/** @var Reservation $reservation */
/** @var Event $model */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('reservation.edit_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card-header text-muted font-bold">
                        {{ __('reservation.edit_title') }}
                    </div>
                    <div class="card-body">

                        @include('components.flash-message')

                        @include('components.validation-error')

                        {{ Form::open(['route' => 'user.reservation.update', 'method' => 'post']) }}
                        @method('POST')
                        @csrf

                        {{ Form::hidden('user_id', auth()->id()) }}
                        {{ Form::hidden('event_id', $model->id) }}
                        {{ Form::hidden('reservation_id', $reservation->id) }}

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label>{{ __('event.attribute_labels.name') }}</label>
                            </div>
                            <div class="col-md-6">
                                <span class="font-bold">{{ $reservation->event->name }}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label>{{ __('reservation.attribute_labels.reservation_user_name') }}</label>
                            </div>
                            <div class="col-md-6">
                                <span class="font-bold">{{ $reservation->user->name }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('reservation.attribute_labels.number_of_people') }}</label>
                            </div>
                            <div class="col-md-6">
                                <select name="number_of_people" class="form-control">
                                    <option value="">予約人数を選択してください</option>
                                    @for($i = 1; $i <= \App\Consts\EventConst::MAX_PEOPLE_RESERVATION; $i++)
                                        <option value="{{ $i }}" @if($i === $reservation->number_of_people) selected @endif >{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('manager.event.show', ['id' => $model->id]) }}'">
                            <i class="fa-solid fa-reply"></i>{{ __('message.btn_labels.back') }}
                        </button>
                        <button class="btn btn-success text-white" type="submit">
                            <i class="fa-solid fa-pen"></i>{{ __('message.btn_labels.edit') }}
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $model->id }}">
                            <i class="fa-solid fa-trash"></i>{{ __('message.btn_labels.delete') }}
                        </button>
                        {{ Form::close() }}
                    </div>

                    @include('components.delete-modal', [
                        'title' => __('reservation.delete_title'),
                        'route' => 'user.reservation.delete',
                        'model' => $reservation,
                    ])

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
