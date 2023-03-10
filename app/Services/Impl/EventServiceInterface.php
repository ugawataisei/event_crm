<?php

namespace App\Services\Impl;

use App\Http\Requests\Manager\Event\EventStoreRequest;
use App\Http\Requests\Manager\Event\EventUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface EventServiceInterface
{
    public function getAllEventsAfterToday(): Collection;

    public function getEventDetails(int $id): array;

    public function checkDuplicationEventTime(EventStoreRequest|EventUpdateRequest $request, string $startDate, string $endDate): bool;

    public function storeEventByRequest(EventStoreRequest $request): Model|RedirectResponse;

    public function updateEventByRequest(EventUpdateRequest $request): Model|RedirectResponse;

    public function deleteEventByRequest(Request $request): void;
}
