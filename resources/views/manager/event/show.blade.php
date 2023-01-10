<?php

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

/** @var Event $model */
/** @var Collection $reservations */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('event.show_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="card">
                <div class="card-header text-gray-500 font-bold">
                    {{ __('event.show_title') }}
                </div>
                <div class="card-body">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                    {{ __('event.attribute_labels.name') }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $model->name }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                    {{ __('event.attribute_labels.information') }}
                                </th>
                                <td class="px-6 py-4">
                                    {!! nl2br($model->information) !!}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                    {{ __('event.attribute_labels.max_people') }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $model->max_people }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                    {{ __('event.attribute_labels.start_date') }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $model->start_date->format('Y年m月d日 h:m') }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                    {{ __('event.attribute_labels.end_date') }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $model->end_date->format('Y年m月d日 h:m') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="button" onclick="location.href='{{ route('manager.event.index') }}'"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2">
                        <i class="fa-solid fa-list"></i>{{ __('message.btn_labels.list') }}
                    </button>
                    <button type="button" onclick="location.href='{{ route('manager.event.edit', ['id' => $model->id]) }}'"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2">
                        <i class="fa-solid fa-pen"></i>{{ __('message.btn_labels.edit') }}
                    </button>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header text-gray-500 font-bold">
                    {{ __('reservation.show_title') }}
                </div>
                <div class="card-body">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('reservation.attribute_labels.reservation_user_name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('reservation.attribute_labels.number_of_people') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('reservation.attribute_labels.created_at') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $reservation)
                                @if($reservation !== null)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $reservation->user->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $reservation->number_of_people }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $model->created_at->format('Y年m月d日 h:m') }}
                                        </td>
                                    </tr>
                                @else
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ __('message.common.no_reservation_information_yet') }}
                                        </th>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2">
                        <i class="fa-regular fa-id-card"></i>{{ __('message.btn_labels.reservation') }}
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
