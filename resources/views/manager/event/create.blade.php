<?php

use App\Consts\EventConst;

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('event.create_title') }}
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
                        {{ Form::open(['route' => 'manager.event.store', 'method' => 'post']) }}
                        @method('POST')
                        @csrf

                        <div class="mb-2">
                            {{ Form::label('name', __('event.attribute_labels.name'), ['class' => 'form-label']) }}
                            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="mb-2">
                            {{ Form::label('information', __('event.attribute_labels.information'), ['class' => 'form-label']) }}
                            {!! Form::textarea('information', old('information'), ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                {{ Form::label('event_date', __('event.attribute_labels.event_date'), ['class' => 'form-label']) }}
                                {{ Form::text('event_date', old('event_date'), ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('start_time', __('event.attribute_labels.start_date'), ['class' => 'form-label']) }}
                                {{ Form::text('start_time', old('start_time'), ['class' => 'form-control', 'id' => 'start_time']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('end_time', __('event.attribute_labels.end_date'), ['class' => 'form-label']) }}
                                {{ Form::text('end_time', old('end_time'), ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="mb-2">
                            {{ Form::label('max_people', __('event.attribute_labels.max_people'), ['class' => 'form-label']) }}
                            {{ Form::select('max_people', EventConst::MAX_PEOPLE_OPTION, null,['class' => 'form-control']) }}
                        </div>
                        <div class="mb-2">
                            {{ Form::label('is_visible', __('event.attribute_labels.is_visible'), ['class' => 'form-label']) }}
                            {{ Form::select('is_visible', EventConst::EVENT_STATUS, null,['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('manager.event.index') }}'">
                            <i class="fa-solid fa-reply"></i>{{ __('message.btn_labels.back') }}
                        </button>
                        <button class="btn btn-success text-white" type="submit">
                            <i class="fa-solid fa-plus"></i>{{ __('message.btn_labels.store') }}
                        </button>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
