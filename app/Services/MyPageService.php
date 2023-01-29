<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use App\Services\Impl\MyPageServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class MyPageService implements MyPageServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllReservedEvents(): Collection
    {
        /** @var User $loginUser */
        $loginUser = User::query()->where('id', Auth::id())
            ->first();

        $reservedEvents = collect([
            'after_today' => collect(),
            'before_today' => collect(),
        ]);


        foreach ($loginUser->events->whereNull('canceled_date') as $event) {
            /** @var Event $event */
            if ($event->start_date >= Carbon::today()) {
                $reservedEvents->get('after_today')->push($event);
            }

            if ($event->start_date < Carbon::today()) {
                $reservedEvents->get('before_today')->push($event);
            }
        }

        return $reservedEvents;
    }
}
