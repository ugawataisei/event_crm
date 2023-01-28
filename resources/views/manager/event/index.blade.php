<?php

use App\Models\Event;

/** @var Event $model */

?>
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight col-md-4">
                {{ __('event.title') }}
            </h2>
            <button type="button" onclick="location.href='{{ route('manager.event.create') }}'"
                    class="btn btn-dark col-md-1 offset-md-7">
                <i class="fa-solid fa-plus"></i>{{ __('message.btn_labels.create') }}
            </button>
        </div>
    </x-slot>

    <div class="row mt-2">
        <div class="col-md-6">
            @include('components.flash-message',[])
        </div>
        <div class="col-md-6"></div>
    </div>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="card text-center">
                    <div class="card-header text-left font-bold bg-light">
                        {{ __('event.title') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <caption></caption>
                            <thead>
                            <tr>
                                <th scope="col">{{ __('event.attribute_labels.id') }}</th>
                                <th scope="col">{{ __('event.attribute_labels.name') }}</th>
                                <th scope="col">{{ __('event.attribute_labels.start_date') }}</th>
                                <th scope="col">{{ __('event.attribute_labels.end_date') }}</th>
                                <th scope="col">{{ __('event.attribute_labels.is_visible') }}</th>
                                <th scope="col">{{ __('message.common.operation') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                                <tr>
                                    <th scope="row">{{ $model->id }}</th>
                                    <td>
                                        <a href="{{ route('manager.event.show', ['id' => $model->id ]) }}">
                                            {{ $model->name }}
                                        </a>
                                    </td>
                                    <td>{{ $model->start_date }}</td>
                                    <td>{{ $model->end_date }}</td>
                                    <td>{!! $model->returnStatusWithBadge() !!}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $model->id }}">
                                            <i class="fa-solid fa-trash"></i>{{ __('message.btn_labels.delete') }}
                                        </button>
                                    </td>
                                </tr>

                                @include('components.delete-modal', [
                                    'title' => __('event.delete_title'),
                                    'route' => 'manager.event.delete',
                                    'model' => $model,
                                ])

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer row bg-light" onclick="location.href='{{ route('dashboard') }}'">
                        <div class="col-md-2">
                            <button class="btn btn-dark">
                                <i class="fa-solid fa-calendar-days"></i>{{ __('message.btn_labels.calendar') }}
                            </button>
                        </div>
                        <div class="col-md-10"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
