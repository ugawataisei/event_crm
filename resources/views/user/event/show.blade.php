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
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="card text-left">
                    <div class="card-header font-bold">
                        {{ __('event.show_title') }}
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
                    <div class="card-footer text-muted">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::select('number_of_people', [], null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-dark">
                                    {{ __('message.btn_labels.reservation') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
