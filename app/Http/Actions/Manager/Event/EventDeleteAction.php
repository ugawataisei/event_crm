<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use App\Services\Impl\EventServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventDeleteAction extends Controller
{
    protected EventService $eventService;

    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $this->eventService->deleteEventByRequest($request);

        return redirect()->route('manager.event.index')->with([
            'status' => 'info',
            'message' => trans('message.common.success_delete'),
        ]);
    }
}
