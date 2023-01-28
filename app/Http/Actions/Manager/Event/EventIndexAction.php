<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use App\Http\Services\EventService;
use App\Http\Services\Impl\EventServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventIndexAction extends Controller
{
    protected EventService $eventService;

    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $models = $this->eventService->getAllEventsAfterToday();

        return view('manager.event.index', compact('models'));
    }
}
