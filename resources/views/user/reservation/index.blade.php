<?php

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

/** @var Reservation $reservation */
/** @var Collection $reservations */

?>
<div class="card text-center mt-5">
    <div class="card-header font-bold bg-light text-left">
        {{ __('reservation.show_title') }}
    </div>
    <div class="card-body my-2">
        @if($reservations->isNotEmpty())
            <table class="table">
                <caption></caption>
                <thead>
                <tr>
                    <th scope="col">{{ __('reservation.attribute_labels.id') }}</th>
                    <th scope="col">{{ __('reservation.attribute_labels.reservation_user_name') }}</th>
                    <th scope="col">{{ __('reservation.attribute_labels.number_of_people') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <th scope="row">{{ $reservation->id }}</th>
                        <td>{{ $reservation->user_id }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <span class="alert alert-dark font-bold" role="alert">
                {{ __('message.common.no_reservation_information_yet') }}
            </span>
        @endif
    </div>
    <div class="card-footer"></div>
</div>
