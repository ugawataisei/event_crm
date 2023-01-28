<?php

use App\Models\Event;

/** @var Event $model */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('event.show_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            <div class="card">
                <div class="card-header bg-light font-bold">
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('event.show_title') }}
                        </div>
                        <div class="col-md-6">

                            @include('components.flash-message', [])

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table table-hover table-striped">
                            <caption></caption>
                            @foreach( __('event.attribute_labels') as $attribute => $transAttribute)
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
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="button"
                            onclick="location.href='{{ route('manager.event.index') }}'"
                            class="btn btn-secondary">
                        <i class="fa-solid fa-list"></i>{{ __('message.btn_labels.list') }}
                    </button>
                    <button type="button"
                            onclick="location.href='{{ route('manager.event.edit', ['id' => $model->id]) }}'"
                            class="btn btn-success">
                        <i class="fa-solid fa-pen"></i>{{ __('message.btn_labels.edit') }}
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $model->id }}"
                            class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>{{ __('message.btn_labels.delete') }}
                    </button>
                </div>
            </div>

            @include('components.delete-modal', [
                'title' => __('event.delete_title'),
                'route' => 'manager.event.delete',
                'model' => $model,
            ])

            @include('user.reservation.index', [])

        </div>
    </div>
</x-app-layout>
