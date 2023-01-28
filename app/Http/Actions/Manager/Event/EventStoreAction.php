<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Event\EventStoreRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Services\Impl\EventServiceInterface;
use Illuminate\Http\RedirectResponse;

class EventStoreAction extends Controller
{
    protected EventService $eventService;

    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     *
     * @param EventStoreRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EventStoreRequest $request): RedirectResponse
    {
        /** @var Event $model */
        $model = $this->eventService->storeEventByRequest($request);

        return redirect()->route('manager.event.edit', ['id' => $model->id])->with([
            'status' => 'info',
            'message' => trans('message.common.success_store'),
        ]);
    }
}
