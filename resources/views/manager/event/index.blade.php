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
                    class="btn btn-primary col-md-1 offset-md-7">
                <i class="fa-solid fa-plus"></i>{{ __('message.btn_labels.create') }}
            </button>
        </div>
    </x-slot>

    @include('components.flash-message')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                {{ __('event.attribute_labels.id') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('event.attribute_labels.name') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('event.attribute_labels.start_date') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('event.attribute_labels.end_date') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('event.attribute_labels.is_visible') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('message.common.operation') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $model)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $model->id }}
                                </th>
                                <td class="py-4 px-6">
                                    <a href="{{ route('manager.event.show', ['id' => $model->id ]) }}">{{ $model->name }}</a>
                                </td>
                                <td class="py-4 px-6">
                                    {{ $model->start_date }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $model->end_date }}
                                </td>
                                <td class="py-4 px-6">
                                    {!! $model->returnStatusWithBadge() !!}
                                </td>
                                <td class="py-4 px-6">
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $model->id }}">
                                        <i class="fa-solid fa-trash"></i>{{ __('message.btn_labels.delete') }}
                                    </button>
                                </td>
                            </tr>

                            @include('components.delete-modal', [
                                'title' => __('event.delete_title'),
                            ])

                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
