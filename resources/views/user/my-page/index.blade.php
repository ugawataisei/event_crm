<?php

use App\Models\Event;
use Illuminate\Support\Collection;

/** @var Collection $reservedEvents */
/** @var Event $event */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('my-page.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">

                <div class="card text-center">
                    <div class="card-header bg-light text-left font-bold">
                        {{ __('my-page.after_today_title') }}
                    </div>
                    <div class="card-body">
                        @if($reservedEvents->get('after_today')->isNotEmpty())
                            <table class="table table-striped table-hover">
                                <caption></caption>
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('my-page.attribute_labels.name') }}</th>
                                    <th scope="col">{{ __('my-page.attribute_labels.reservation_user_name') }}</th>
                                    <th scope="col">{{ __('my-page.attribute_labels.number_of_people') }}</th>
                                    <th scope="col">{{ __('my-page.attribute_labels.created_at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservedEvents->get('after_today') as $event)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('user.event.show', ['id' => $event->id]) }}"
                                               class="font-bold">
                                                {{ $event->name}}
                                            </a>
                                        </th>
                                        <td>{{ $event->pivot->user_id }}</td>
                                        <td>{{ $event->pivot->number_of_people }}</td>
                                        <td>{{ $event->pivot->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="alert alert-danger" role="alert">
                                    予約情報がまだありません
                            </span>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-secondary"
                                onclick="location.href='{{ route('dashboard') }}'">
                            <i class="fa-solid fa-calendar-days"></i>{{ __('message.btn_labels.back') }}
                        </button>
                    </div>
                </div>

                <div class="card text-center mt-5">
                    <div class="card-header text-left font-bold">
                        {{ __('my-page.before_today_title') }}
                    </div>
                    <div class="card-body">
                        @if($reservedEvents->get('before_today')->isNotEmpty())
                            <table class="table table-striped table-hover">
                                <caption></caption>
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('my-page.attribute_labels.name') }}</th>
                                    <th scope="col">{{ __('my-page.attribute_labels.reservation_user_name') }}</th>
                                    <th scope="col">{{ __('my-page.attribute_labels.number_of_people') }}</th>
                                    <th scope="col">{{ __('my-page.attribute_labels.canceled_date') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservedEvents->get('before_today') as $event)
                                    <tr>
                                        <th scope="row">{{ $event->name }}</th>
                                        <td>{{ $event->pivot->user_id }}</td>
                                        <td>{{ $event->pivot->number_of_people }}</td>
                                        <td>{{ $event->pivot->canceled_date }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="alert alert-danger" role="alert">
                                    過去予約情報がまだありません
                            </span>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-secondary"
                                onclick="location.href='{{ route('dashboard') }}'">
                            <i class="fa-solid fa-calendar-days"></i>{{ __('message.btn_labels.back') }}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
