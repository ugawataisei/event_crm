<?php

use App\Models\Event;
use App\Consts\EventConst;

/** @var Event $model */
/** @var int $old_max_people_key */
/** @var int $old_is_visible_key */
/** @var string $event_date */
/** @var string $start_time */
/** @var string $end_time */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('event.edit_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="card">
                    <div class="card-header text-muted font-bold">
                        <div class="row">
                            <div class="col-md-6">
                                {{ __('event.edit_title') }}
                            </div>
                            <div class="col-md-6">

                                @include('components.flash-message', [])

                                @include('components.validation-error', [])

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route' => 'manager.event.update', 'method' => 'post']) }}
                        @method('POST')
                        @csrf

                        {{ Form::hidden('id', $model->id) }}
                        <div class="mb-2">
                            {{ Form::label('name', __('event.attribute_labels.name'), ['class' => 'form-label']) }}
                            {{ Form::text('name', $model->name, ['class' => 'form-control']) }}
                        </div>
                        <div class="mb-2">
                            {{ Form::label('information', __('event.attribute_labels.information'), ['class' => 'form-label']) }}
                            {!! Form::textarea('information', nl2br($model->information), ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                {{ Form::label('event_date', __('event.attribute_labels.event_date'), ['class' => 'form-label']) }}
                                {{ Form::text('event_date', $event_date, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('start_time', __('event.attribute_labels.start_date'), ['class' => 'form-label']) }}
                                {{ Form::text('start_time', $start_time, ['class' => 'form-control', 'id' => 'start_time']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('end_time', __('event.attribute_labels.end_date'), ['class' => 'form-label']) }}
                                {{ Form::text('end_time', $end_time, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="mb-2">
                            {{ Form::label('max_people', __('event.attribute_labels.max_people'), ['class' => 'form-label']) }}
                            {{ Form::select('max_people', EventConst::MAX_PEOPLE_OPTION, $old_max_people_key,['class' => 'form-control']) }}
                        </div>
                        <div class="mb-2">
                            {{ Form::label('is_visible', __('event.attribute_labels.is_visible'), ['class' => 'form-label']) }}
                            {{ Form::select('is_visible', EventConst::EVENT_STATUS, $old_is_visible_key,['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary" type="button"
                                onclick="location.href='{{ route('manager.event.show', ['id' => $model->id]) }}'">
                            <i class="fa-solid fa-reply"></i>{{ __('message.btn_labels.back') }}
                        </button>
                        <button class="btn btn-success" type="submit">
                            <i class="fa-solid fa-paper-plane"></i>{{ __('message.btn_labels.update') }}
                        </button>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
