<?php

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

/** @var Event $model */
/** @var Collection $reservations */
/** @var null|int $available_reserved_event_people */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('event.show_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card text-left">
                    <div class="card-header font-bold">
                        <div class="row">
                            <div class="col-md-3">
                                {{ __('event.show_title') }}
                            </div>
                            <div class="col-md-9">
                                @include('components.flash-message')
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            @php
                                $notDisplayAttributes = ['id', 'is_visible', 'created_at', 'updated_at', 'event_date'];
                            @endphp
                            @foreach( __('event.attribute_labels') as $attribute => $transAttribute)
                                @if(in_array($attribute, $notDisplayAttributes, true) === false)
                                    @if($attribute === 'information')
                                        <tr class="border">
                                            <th class="border bg-light" scope="col">{{ $transAttribute }}</th>
                                            <td>{{ nl2br($model->$attribute) }}</td>
                                        </tr>
                                    @else
                                        <tr class="border">
                                            <th class="border bg-light" scope="col">{{ $transAttribute }}</th>
                                            <td>{{ $model->$attribute }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="card-footer">
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
                                @if($available_reserved_event_people === null)
                                    <span class="alert-danger">
                                        {{ __('message.common.fill_reservation_people') }}
                                    </span>
                                @else
                                    <select name="number_of_people" class="form-control">
                                        <option value="">予約人数を選択してください</option>
                                        @for($i = 1; $i <=$available_reserved_event_people ; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                @endif
                            </div><div class="col-md-6"></div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fa-regular fa-id-card"></i>{{ __('message.btn_labels.reservation') }}
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-light" onclick="location.href='{{ route('dashboard') }}'">
                                    <i class="fa-solid fa-reply"></i>{{ __('message.btn_labels.back') }}
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
