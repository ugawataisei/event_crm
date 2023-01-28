<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Event\EventUpdateRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Services\Impl\EventServiceInterface;
use Illuminate\Http\RedirectResponse;

class EventUpdateAction extends Controller
{
    protected EventService $eventService;

    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     *
     * @param EventUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EventUpdateRequest $request): RedirectResponse
    {
        /** @var Event $model */
        $model = $this->eventService->updateEventByRequest($request);

        return redirect()->route('manager.event.edit', ['id' => $model->id])->with([
            'status' => 'info',
            'message' => trans('message.common.success_update'),
        ]);
    }
}
